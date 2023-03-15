<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('class')->insert([
            ['name' => '1A'],
            ['name' => '2B '],
            ['name' => '3C'],
            ['name' => '4D']
        ]);
        DB::table('gender')->insert([
            ['name' => 'Nam'],
            ['name' => 'Nu ']
        ]);
        DB::table('student')->insert([
            ['name' => 'hocsinh1',
               'class'=> 1,
                'gender'=> 2],
            ['name' => 'hocsinh2',
                'class'=> 3,
                'gender'=> 2],
            ['name' => 'hocsinh3',
                'class'=> 1,
                'gender'=> 1],
            ['name' => 'hocsinh11',
                'class'=> 3,
                'gender'=> 2],
            ['name' => 'hocsinh21',
                'class'=> 4,
                'gender'=> 2],
            ['name' => 'hocsinh31',
                'class'=> 4,
                'gender'=> 1],
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
