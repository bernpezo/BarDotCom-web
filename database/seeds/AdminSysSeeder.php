<?php

use Illuminate\Database\Seeder;

class AdminSysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('administrador_sistemas')->insert(
            ['id' => '1',]
        );
    }
}
