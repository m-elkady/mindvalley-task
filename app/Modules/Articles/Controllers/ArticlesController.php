<?php

namespace App\Modules\Articles\Controllers;

use App\Base\Controller;
use App\Base\Requests\IndexRequest;
use App\Modules\Articles\Models\Article;
use App\Modules\Articles\Requests\AddRequest;
use App\Modules\Articles\Requests\UpdateRequest;

class ArticlesController extends Controller
{
    public $model = Article::class;
    public $viewsPath = 'Articles.Views';
    public $routingBase = 'admin.articles';

    public function create()
    {
        $model = new $this->model;
        $request = new AddRequest($this, $model);
        $data = $this->request->all();

        return $request->load($data)->process();
    }

    public function update()
    {
        $model = new $this->model;
        $request = new UpdateRequest($this, $model);
        $data = $this->request->all();

        return $request->load($data)->process();
    }
}