<?php

namespace App\Http\Controllers;

use App\Modules\Articles\Models\Article;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data = Article::with('article_images')->paginate();

        return view('welcome', compact('data'));
    }

    public function post($id)
    {
        $post = Article::findOrFail($id);

        return view('post', compact('post'));
    }
}