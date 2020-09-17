<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Mehnat\User\Entities\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 20)->create();
    }
}
