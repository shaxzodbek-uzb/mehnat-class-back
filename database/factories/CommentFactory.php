<?php

namespace Database\Factories;

use DB;
use App\Models\Comment;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;


$factory->define(Comment::class, function (Faker $faker) {

    $user_ids = DB::table('users')->pluck('id')->toArray();
    $article_ids = DB::table('articles')->pluck('id')->toArray();

    $user_key = array_rand($user_ids);
    $article_key = array_rand($article_ids);

    return [
        'user_id' => $user_ids[$user_key],
        'article_id' => $article_ids[$article_key],
        'text' => $faker->text(100)
    ];
});