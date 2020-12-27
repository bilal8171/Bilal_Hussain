<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('modules')->insert([
            'module_name' => 'Posts',
            'module_status' =>1,
        ]);

        DB::table('modules')->insert([
            'module_name' => 'Users',
            'module_status' =>1,
        ]);
        
        DB::table('modules')->insert([
            'module_name' => 'Tags',
            'module_status' =>1,
        ]);
        
        DB::table('modules')->insert([
            'module_name' => 'Profile',
            'module_status' =>1,
        ]);


    }
}
