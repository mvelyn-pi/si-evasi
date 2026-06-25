<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sisakti.id'],
            [
                'name'     => 'Administrator',
                'password' => Hash::make('Admin@1234'),
                'role'     => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'evaluator@sisakti.id'],
            [
                'name'     => 'Evaluator Demo',
                'password' => Hash::make('Eval@1234'),
                'role'     => 'evaluator',
            ]
        );
    }
}
