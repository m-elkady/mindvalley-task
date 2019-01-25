<?php

use Faker\Generator as Faker;
use \App\Modules\Articles\Models\ArticleImages;

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

$factory->define(ArticleImages::class, function (Faker $faker) {
    $image = $faker->image(public_path('images'), 640, 480, null, false);

    return [
      'image' => 'images/' . $image
    ];
});
