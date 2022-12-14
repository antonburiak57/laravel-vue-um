<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(User::class)->create();

        User::create([
            'role' => 1,
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123456789'),
            'gender' => 'male',
            'degree' => 'bachelor',
            'street' => 'test',
            'street_no' => 'test',
            'postal_code' => 'test',
            'city' => 'test'
        ]);

        User::create([
            'role' => 2,
            'first_name' => 'normal',
            'last_name' => 'normal',
            'email' => 'normal@example.com',
            'password' => bcrypt('normal123456789'),
            'gender' => 'male',
            'degree' => 'bachelor',
            'street' => 'test',
            'street_no' => 'test',
            'postal_code' => 'test',
            'city' => 'test'
        ]);
    }
}
