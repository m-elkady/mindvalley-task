<?php

namespace App\Base\Requests;

use App\Base\Controller;
use App\Base\Model;
use App\Base\Request;

class IndexRequest extends Request
{
    public $controller;
    public $model;
    public $requestAttributes = [
      'page',
      'perPage',
      'orderBy',
      'order',
    ];
    public $filterAttributes = [];

    public function __construct(Controller $controller, Model $model)
    {
        $this->controller = $controller;
        $this->model = $model;
    }

    public function attributes()
    {
        return array_merge($this->requestAttributes, array_keys($this->model->requestAttributes));
    }

    public function rules()
    {
        return [];
    }

    public function process()
    {

        $data = $this->model->pagination($this);

        return view($this->controller->viewsPath . '.index', compact('data'));
    }
}