<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Super',
            'email' => 'super@gmail.com',
            'password' => bcrypt('super'),
            'role' => 'Super Admin',
        ]);

        DB::table('users')->insert([
            'name' => 'Reader',
            'email' => 'reader@gmail.com',
            'password' => bcrypt('reader'),
            'role' => 'Reader',
        ]);

        DB::table('users')->insert([
            'name' => 'Editor',
            'email' => 'editor@gmail.com',
            'password' => bcrypt('editor'),
            'role' => 'Editor',
        ]);
    }
}
