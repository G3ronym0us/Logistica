<?php

use Illuminate\Database\Seeder;

class UnidadMedidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\UnidadMedida::create([
            'name' => 'RESMA',
        ]);
        App\UnidadMedida::create([
            'name' => 'UNIDAD',
        ]);
        App\UnidadMedida::create([
            'name' => 'DOCENA',
        ]);
    }
}
