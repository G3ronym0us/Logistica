<?php

use Illuminate\Database\Seeder;

class BeneficiarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Beneficiario::class, 50)->create();
    }
}
