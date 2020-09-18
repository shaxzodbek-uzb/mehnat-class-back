<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExampleDatabaseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDatabase()
    {
        // Make call to application...

        $this->assertDatabaseMissing('users', [
            'username' => 'fdf',
        ]);
        $this->assertDatabaseHas('users', [
            'username' => 'pkoss',
        ]);
    }

}
