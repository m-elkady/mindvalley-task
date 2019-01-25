<?php

namespace App\Base\Requests;

use App\Base\Controller;
use App\Base\Model;
use App\Base\Request;

class DoOperationRequest extends Request
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
        return [
            'chk',
            'operation'
        ];
    }

    public function rules()
    {
        return [
            'chk' => 'required',
            'operation' => 'required'
        ];
    }

    public function process()
    {
        if ($this->validate()) {
            $items = $this->model->whereIn('id',$this->chk);
            $operation = $this->operation;

            if ($items->{$operation}()) {
                flash(sprintf('%s has been operated successfully', ucfirst($this->model->name)))->success();

                return redirect(route($this->controller->routingBase . '.index'));
            }
        }

        flash('Error !')->error();

        return redirect()->back()->withErrors($this->errors)->withInput($this->getAttributes());

    }
}