<?php

namespace Tests\Feature;

use App\Models\Users;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testUser(): void
    {

        // createRole();
        $user = Users::factory()->make()->toArray(); 

        $response = $this->postJson('api/register', $user);

        // dd($response->json());

        
        expect($response->status())->toBe(201);
        expect($response->json('user.name'))->toBe($user['name']);
    }
}
