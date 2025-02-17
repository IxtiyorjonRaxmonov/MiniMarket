<?php

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

 /**
     * A basic feature test example.
     */
    test('role can be created', function () {
        $role = createRole();

        $table = Schema::hasTable('roles');
        expect($table)->toBeTrue();
        expect(Role::where('id', $role->id)->exists())->toBeTrue();

    });

