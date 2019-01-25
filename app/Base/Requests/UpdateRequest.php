<?php

namespace App\Base\Requests;

use App\Base\Controller;
use App\Base\Model;
use App\Base\Request;

class UpdateRequest extends Request
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
        return array_merge(['id'], array_keys($this->model->requestAttributes));

    }

    public function rules()
    {
        return array_merge($this->model->rules['common'], $this->model->rules['update']);
    }

    public function process()
    {
        if ($this->validate()) {
            $model = $this->model->findOrFail($this->id);
            $attributes = $this->getAttributes();
            unset($attributes['id']);
            foreach ($attributes as $attribute => $value) {
                if (isset($value)) {
                    $model->{$attribute} = $value;
                }
            }

            if ($model->update()) {
                flash(sprintf('%s has been updated successfully', ucfirst($this->model->name)))->success();

                return redirect(route($this->controller->routingBase . '.index'));
            }
        }



        flash(sprintf('%s has not been created successfully', ucfirst($this->model->name)))->error();

        return redirect()->back()->withErrors($this->errors)->withInput($this->getAttributes());

    }
}