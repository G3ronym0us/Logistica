<?php

use Illuminate\Database\Seeder;

class DetallesCorrelativoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\DetallesCorrelativo::class, 30)->create();
    }
}
