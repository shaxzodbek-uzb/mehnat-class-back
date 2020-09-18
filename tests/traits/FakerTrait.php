<?php

namespace Tests\traits;

use Illuminate\Support\Str;
use Faker\Factory as Faker;

trait FakerTrait
{
    /**
     * Get fake data 
     *
     * @param array $postFields
     * @return array
     */
    public function fakeUserData()
    {
        $faker = Faker::create();

        return [            
            'fullname' => $faker->firstName . ' ' . $faker->lastName,
            'username' => $faker->unique()->userName,
            'age' => $faker->numberBetween(18, 22),
            'remember_token' => Str::random(10),
            'password' => bcrypt(123456),

        ];
    }
}