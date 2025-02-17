<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users>
 */
class UsersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Users::class;
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'surname' => fake()->lastName(),
            'username' => fake()->unique()->userName(),
            'role_id' => Role::firstOrCreate(['id' => 1], ['role' => 'Admin'])->id,
            'password' => Hash::make('password')
        ];
    }
}
