<?php

namespace App\Base;

use App\Base\Requests\AddRequest;
use App\Base\Requests\DeleteRequest;
use App\Base\Requests\DoOperationRequest;
use App\Base\Requests\IndexRequest;
use App\Base\Requests\UpdateRequest;
use Illuminate\Routing\Controller as BaseController;
use \Illuminate\Http\Request as Request;

class Controller extends BaseController
{
    public $request;
    public $model = null;
    public $viewsPath = null;
    public $routingBase = null;
    public $id = null;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $model = new $this->model;
        $request = new IndexRequest($this, $model);
        $data = $this->request->all();

        return $request->load($data)->process();
    }

    public function add()
    {
        return view($this->viewsPath . '.add', (new $this->model)->getAdminViewVars($this->routingBase));
    }

    public function create()
    {
        $model = new $this->model;
        $request = new AddRequest($this, $model);
        $data = $this->request->all();

        return $request->load($data)->process();
    }

    public function edit($id)
    {
        return view($this->viewsPath . '.add', (new $this->model)->getAdminViewVars($this->routingBase, $id));
    }

    public function update()
    {
        $model = new $this->model;
        $request = new UpdateRequest($this, $model);
        $data = $this->request->all();

        return $request->load($data)->process();
    }

    public function delete($id)
    {
        $model = new $this->model();
        $request = new DeleteRequest($this, $model);
        $data = $this->request->all();
        $data['id'] = $id;

        return $request->load($data)->process();
    }

    public function doOperation()
    {
        $model = new $this->model();
        $request = new DoOperationRequest($this, $model);
        $data = $this->request->all();

        return $request->load($data)->process();
    }

//    public function view($id)
//    {
//        $request = new ViewRequest(new $this->model());
//        $data = $this->request->all();
//
//        return $request->load($data)->process();
//    }

}