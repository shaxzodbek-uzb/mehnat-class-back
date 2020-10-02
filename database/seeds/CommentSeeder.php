<?php

namespace Database\Seeders;

use Mehnat\Comment\Entities\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Comment::class, 30)->create();
    }
}
