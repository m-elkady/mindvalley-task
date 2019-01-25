<?php

namespace App\Modules\Articles\Requests;

use App\Base\Controller;
use App\Base\Request;
use App\Base\Model;

class AddRequest extends Request
{

    public $controller;
    public $model;

    public function __construct(Controller $controller, Model $model)
    {
        $this->controller = $controller;
        $this->model = $model;
    }

    public function attributes()
    {
        return array_keys($this->model->requestAttributes);
    }

    public function rules()
    {
        return array_merge($this->model->rules['common'], $this->model->rules['create']);
    }

    public function process()
    {
        if ($this->validate()) {
            $data = $this->getAttributes();

            $this->model->setRawAttributes(array_only($data, ['title', 'content', 'tags']));
            if ($this->model->save()) {
                $this->model->saveRelations(array_only($data, ['article_images']));

                flash(sprintf('%s has been created successfully', ucfirst($this->model->name)))->success();

                return redirect(route($this->controller->routingBase . '.index'));
            }
        }

        flash(sprintf('%s has not been created successfully', ucfirst($this->model->name)))->error();

        return redirect()->back()->withErrors($this->errors)->withInput($this->getAttributes());
    }

}