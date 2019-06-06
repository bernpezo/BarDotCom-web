<?php

use Illuminate\Database\Seeder;
use App\Administrador_sistema;

class AdminSysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminsys=[
            'id' => '1',
        ];
        Administrador_sistema::create($adminsys);
    }
}
