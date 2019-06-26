<?php

use Illuminate\Database\Seeder;
use App\Rubro;

class RubroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rubros=[
            ['id' => '561000','nombre' => 'ACTIVIDADES DE RESTAURANTES Y DE SERVICIO MÓVIL DE COMIDAS'],
            ['id' => '562100','nombre' => 'SUMINISTRO DE COMIDAS POR ENCARGO (SERVICIOS DE BANQUETERÍA)'],
            ['id' => '562900','nombre' => 'SUMINISTRO INDUSTRIAL DE COMIDAS POR ENCARGO; CONCESIÓN DE SERVICIOS DE ALIMENTACIÓN'],
            ['id' => '563001','nombre' => 'ACTIVIDADES DE DISCOTECAS Y CABARET (NIGHT CLUB), CON PREDOMINIO DEL SERVICIO DE BEBIDAS'],
            ['id' => '563009','nombre' => 'OTRAS ACTIVIDADES DE SERVICIO DE BEBIDAS N.C.P.']
        ];
        foreach($rubros as $rubro){
            Rubro::create($rubro);
        }
    }
}
