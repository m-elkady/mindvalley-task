<?php

namespace App\Providers;

use App\Modules\Articles\Models\Article;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Form;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Form::component('bsText', 'components.form.text', ['name', 'value' => null, 'attributes' => []]);
        Form::component('bsSelect', 'components.form.select', ['name', 'options' => [], 'value' => null, 'attributes' => []]);
        Form::component('bsTextArea', 'components.form.textArea', ['name', 'value' => null, 'attributes' => []]);
        $recentPosts = Article::latest()->limit(5)->get();
        View::share('recentPosts',$recentPosts);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
