<?php

use Faker\Generator as Faker;
use \App\Modules\Articles\Models\Article;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Article::class, function (Faker $faker) {
    return [
      'title'   => $faker->sentence(),
      'content' => $faker->paragraphs(3, true),
      'tags'    => implode(',', $faker->words())
    ];
});
