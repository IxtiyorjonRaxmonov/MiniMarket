<?php

use App\Models\Users;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\get;

it('has productapi page', function () {
    $role = createRole();
    $user = Users::create([
        "name" => "Rashid",
        "surname" => "Kamolov",
        "username" => "development",
        "password" =>Hash::make("123qaz"),
        "role_id" => 1
    ]);
    $token = $user->createToken('TestPest')->plainTextToken;
    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token
    ])->get('api/product');
    
    // $response = get('api/product',$token);

    expect($response->status())->toBe(200);
});
