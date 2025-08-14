<?php

namespace Database\Seeders;

use App\Models\Loja;
use Illuminate\Database\Seeder;

class LojaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Loja::create([
            'nome_loja' => 'Super 10',
            'email'     => 'super-dez@email.com'
        ]);

        Loja::factory(10)->create();
    }
}
