<?php

use Illuminate\Database\Seeder;
use App\Modules\Articles\Models\Article;
use App\Modules\Articles\Models\ArticleImages;

class ArticlesSeeder extends Seeder
{
    public function run()
    {
        factory(Article::class, 50)->create()->each(function ($article) {
            $article->article_images()->save(factory(ArticleImages::class)->make());
        });
    }

}