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
        $types = [
            ['name' => 'PC'],
            ['name' => 'Laptop'],
            ['name' => 'Headphone'],
            ['name' => 'Mouse'],
            ['name' => 'Monitor']
        ];

        $roles = [
            ['name' => 'admin'],
            ['name' => 'user']
        ];

        $statuses = [
            ['name' => 'pending'],
            ['name' => 'lent'],
            ['name' => 'open']
        ];

        DB::table('types')->insert($types);
        DB::table('roles')->insert($roles);
        DB::table('statuses')->insert($statuses);


        $this->call(UsersTableSeeder::class);
        $this->call(DevicesTableSeeder::class);
    }
}
