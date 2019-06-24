<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=[
            'nombre' => 'admin',
            'apellido' => 'admin',
            'email' => 'admin@bardotcom.cl',
            'password' => '$2y$10$2b6gp1kfnm3Q4ESUWpgxh.Ry7ksNlPTJ2zfVNR1vdo6j/fGxfMvaa',
            'fechaNacimiento' => '1991-02-15',
            'telefono' => '7486532',
        ];
        User::create($user);
    }
}
