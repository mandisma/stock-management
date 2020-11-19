<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductMovement;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::firstOrcreate([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin'),
        ]);

        Product::factory(35)
            ->has(ProductMovement::factory()->count(3), 'movements')
            ->create();
    }
}
