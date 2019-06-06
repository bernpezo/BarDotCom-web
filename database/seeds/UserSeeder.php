<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            ['nombre' => 'admin',
            'apellido' => 'admin',
            'email' => 'admin@bardotcom.cl',
            'password' => '$2y$10$2b6gp1kfnm3Q4ESUWpgxh.Ry7ksNlPTJ2zfVNR1vdo6j/fGxfMvaa',
            'fechaNacimiento' => '1991-02-15',
            'comuna' => '99',
            'telefono' => '7486532',]
        );
    }
}
