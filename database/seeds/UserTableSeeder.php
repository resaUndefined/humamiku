<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role_name' => 'admin',
            'level' => 1,
        ]);

        DB::table('users')->insert([
            'role_id' => 1,
            'name' => 'admin Humamiku',
            'email' => 'admin@mail.com',
            'password' => bcrypt('qwe123'),
        ]);
    }
}
