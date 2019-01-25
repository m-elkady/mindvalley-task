<?php

namespace App\Base;

use Illuminate\Database\Eloquent\Builder;
use \Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    /**
     * @var array $rules rules will be applied
     */
    public $rules = [
      'common' => [],
      'create' => [],
      'update' => ['id' => 'required'],
      'delete' => ['id' => 'required']
    ];

    public $relations = [];
    public $displayField = 'title';
    public $name = '';
    public $requestAttributes = [];
    public $orderBy = 'id';
    public $order = 'asc';
    public $perPage = 20;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->name = str_singular($this->table);
    }

    /**
     * @param array $conditions
     * @return mixed
     */
    public function getList($conditions = [])
    {
        $data = $this->select([$this->primaryKey, $this->displayField]);
        foreach ($conditions as $where => $condition) {
            $data = $data->{$where}($condition);
        }
        $data = $data->get();

        return $data->mapWithKeys(function ($value) {
            return [$value->{$this->primaryKey} => $value->{$this->displayField}];
        })->all();
    }

    /**
     * @return array
     */
    public function getRelationsVars()
    {
        $variables = [];
        foreach ($this->relations as $var => $relation) {
            $includeInListing = $relation['includeInListing'] ?? false;
            if (!$includeInListing) {
                continue;
            }
            $model = $relation['className'] ?? $relation;
            $conditions = $relation['conditions'] ?? [];
            $variables[$var] = (new $model())->getList($conditions);
        }

        return $variables;
    }

    /**
     * Get pagination items for listing pages
     * @param $query
     * @param Request $request
     * @return mixed
     */
    public function scopePagination($query, Request $request)
    {
        $perPage = $request->perPage ? intval($request->perPage) : $this->perPage;
        $orderBy = $request->orderBy ? $request->orderBy : $this->orderBy;
        $order = $request->order ? $request->order : $this->order;
        $page = $request->page ?? null;

        $this->setPerPage($perPage);

        $attributes = !empty($this->requestAttributes) ? $this->requestAttributes : [];

        foreach ($attributes as $attribute => $value) {
            if ($request->{$attribute}) {
                if (isset($this->requestAttributes[$attribute])) {
                    $condition = $this->requestAttributes[$attribute];
                    $value = $condition == 'like' ? "%{$request->{$attribute}}%" : $request->{$attribute};
                    $query->where($attribute, $condition, $value);
                } else {
                    $query->where($attribute, $request->{$attribute});
                }
            }
        }
        $query->withRelations();
        $query->orderBy($orderBy, $order);

        return $query->paginate()->appends($request->getAttributes());
    }

    /**
     * get all relations for pagination
     * @param $query
     * @return mixed
     */
    public function scopeWithRelations(Builder $query)
    {
        foreach ($this->relations as $name => $relation) {
            $includeInListing = $relation['includeInListing'] ?? false;
            if (!$includeInListing) {
                continue;
            }
            $query = $query->with($name);
        }

        return $query;
    }

    /**
     * @param string $routingBase
     * @param null $id
     * @return array
     */
    public function getBasicViewVars(string $routingBase, $id = null)
    {
        $vars['data'] = $id ? $this->findOrfail($id) : $this;
        $vars['route'] = $id ? $routingBase . '.edit' : $routingBase . '.add';

        return $vars;
    }

    /**
     * merge the basic view vars and relations called in Abstract Controller
     * @param string $routingBase
     * @param null $id
     * @return array
     */
    final public function getAdminViewVars(string $routingBase, $id = null)
    {
        return array_merge($this->getBasicViewVars($routingBase, $id), $this->getRelationsVars());
    }



}