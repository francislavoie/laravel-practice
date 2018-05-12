<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            [
                'id' => 1,
                'user_roles_id' => 1,
                'username' => 'I_Admin',
                'email' => 'admin@test.com',
                'password' => \Hash::make('secret'),
                'remember_token' => str_random(10),
                'created_at' => '2017-05-20 12:42:53',
                'updated_at' => '2017-05-20 12:42:53'
            ],
            [
                'id' => 2,
                'user_roles_id' => 2,
                'username' => 'I_Publish',
                'email' => 'publisher@test.com',
                'password' => \Hash::make('secret'),
                'remember_token' => str_random(10),
                'created_at' => '2017-05-20 13:05:53',
                'updated_at' => '2017-05-22 15:08:53'
            ],
            [
                'id' => 3,
                'user_roles_id' => 3,
                'username' => 'I_Use',
                'email' => 'user@test.com',
                'password' => \Hash::make('secret'),
                'remember_token' => str_random(10),
                'created_at' => '2017-05-21 13:05:53',
                'updated_at' => '2017-05-21 13:05:53'
            ],
            [
                'id' => 4,
                'user_roles_id' => 3,
                'username' => 'I_Use_Too',
                'email' => 'user2@test.com',
                'password' => \Hash::make('secret'),
                'remember_token' => str_random(10),
                'created_at' => '2017-05-22 14:05:53',
                'updated_at' => '2017-05-22 14:05:53'
            ],
        ]);

        \DB::table('user_addresses')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'address' => '123 fake street',
                'province' => 'Ontario',
                'city' => 'Ottawa',
                'country' => 'Canada',
                'postal_code' => '123 w4t',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'address' => '123 queen street',
                'province' => 'Quebec',
                'city' => 'Gatineau',
                'country' => 'Canada',
                'postal_code' => '123 tdf',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'user_id' => 3,
                'address' => '123 major road',
                'province' => 'Ontariofdgdgdfg',
                'city' => 'Ottawa',
                'country' => 'Canada',
                'postal_code' => '145 w4t',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 4,
                'user_id' => 4,
                'address' => '123 blue street',
                'province' => 'Ontario',
                'city' => 'Ottawa',
                'country' => 'Canada',
                'postal_code' => '145 lpo',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
