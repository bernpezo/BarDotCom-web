<?php

use Illuminate\Database\Seeder;
use App\Comuna;

class ComunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comunas=[
            ['id' => '99',
            'nombre' => 'nada'],
            ['id' => '15101',
            'nombre' => 'Arica',]
        ];
        foreach($comunas as $comuna){
            Comuna::create($comuna);
        }
    }
}
