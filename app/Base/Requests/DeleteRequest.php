<?php

namespace App\Base\Requests;

use App\Base\Controller;
use App\Base\Model;
use App\Base\Request;

class DeleteRequest extends Request
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
        return ['id'];

    }

    public function rules()
    {
        return $this->model->rules['delete'];
    }

    public function process()
    {

        if ($this->validate()) {

            if ($this->model->destroy($this->id)) {
                flash(sprintf('%s has been deleted successfully', ucfirst($this->model->name)))->success();

                return redirect(route($this->controller->routingBase . '.index'));
            }
        }



        flash(sprintf('%s has not been deleted successfully', ucfirst($this->model->name)))->error();

        return redirect()->back()->withErrors($this->errors)->withInput($this->getAttributes());

    }
}