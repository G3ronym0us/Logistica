<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BeneficiarioSeeder::class);
        $this->call(MunicipioSeeder::class);
        $this->call(CorrelativoSeeder::class);
        $this->call(CatalogoSeeder::class);
        $this->call(UnidadMedidaSeeder::class);
        $this->call(UserSeeder::class);
    }
}
