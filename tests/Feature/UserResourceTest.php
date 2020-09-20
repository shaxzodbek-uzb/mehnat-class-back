<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Str;
use Tests\traits\FakerTrait;
use Mehnat\User\Entities\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserResourceTest extends TestCase
{
    use FakerTrait;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testIndexUser()
    {
        $response = $this->json('GET', 'api/v1/users');

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    public function testStoreUser()
    {
        $response = $this->json('POST', 'api/v1/users', [
            'username' => 'Sally ' . Str::random(3),
            'fullname' => 'Smith',
            'password' => bcrypt(123456),
            'age' => 19
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    public function testShowUser()
    {
        $response = $this->json('GET', 'api/v1/users/7');

        $response
            ->assertStatus(200)            
            ->assertJson([
                'success' => true,
            ]);
    }

    public function testUpdateUser()
    {
        $input = $this->fakeUserData();

        $response = $this->putJson('api/v1/users/7', $input);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }
}
