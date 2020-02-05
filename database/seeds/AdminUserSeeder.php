<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            [
                'email' => 'admin', 
                'role_id' => 1
            ], 
            [
                'name' => 'Administrator',
                'email' => 'admin@gmail.com', 
                'password' => Hash::make('admin123')
            ]
        );
    }
}
