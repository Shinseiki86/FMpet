<?php

use Illuminate\Database\Seeder;
use App\Models\Pais;

class PaisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('---Seeder Paises');
        Pais::create([
            'PAIS_CODIGO'       => 57,
            'PAIS_NOMBRE'  =>  'COLOMBIA',
        ]);
    }
}