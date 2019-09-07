<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kas')->insert([
            'tanggal' => '2019-09-06',
            'sisa_saldo' => '2236900',
        ]);
    }
}
