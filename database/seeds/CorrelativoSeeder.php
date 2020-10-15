<?php

use Illuminate\Database\Seeder;

class CorrelativoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Correlativo::class, 15)->create();
    }
}
