<?php

namespace Database\Factories;

use DB;
use App\Models\Article;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

$factory->define(Article::class, function (Faker $faker) {

    $users_id = DB::table('users')->pluck('id')->toArray();
    $key = array_rand($users_id);
        return [
            'user_id' => $users_id[$key],
            'alias' => $faker->text(50),
            'text' => $faker->text(500)
        ];

});
