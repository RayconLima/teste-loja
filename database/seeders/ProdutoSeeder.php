<?php

namespace Database\Seeders;

use App\Models\{Loja, Produto};
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
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
        
        Loja::factory(10)->create()->each(function ($loja) {
            Produto::factory(5)->create(['loja_id' => $loja->id]);
        });
        Produto::factory(50)->create();
    }
}
