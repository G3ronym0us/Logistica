<?php

use Illuminate\Database\Seeder;

class MunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Municipio::create([
            'name' => 'Angostura'
        ]);
        App\Municipio::create([
            'name' => 'Caroni'
        ]);
        App\Municipio::create([
            'name' => 'Cedeño'
        ]);
        App\Municipio::create([
            'name' => 'Chien'
        ]);
        App\Municipio::create([
            'name' => 'El Callao'
        ]);
        App\Municipio::create([
            'name' => 'Gran Sabana'
        ]);
        App\Municipio::create([
            'name' => 'Angostura del Orinoco'
        ]);
        App\Municipio::create([
            'name' => 'Piar'
        ]);
        App\Municipio::create([
            'name' => 'Roscio'
        ]);
        App\Municipio::create([
            'name' => 'Sifonte'
        ]);
        App\Municipio::create([
            'name' => 'Sucre'
        ]);
    }
}
