<?php

namespace Tests\Traits;

use App\Models\User;
use Laravel\Sanctum\Sanctum;

/**
 * Trait para autenticar automaticamente um usuário com Sanctum
 * antes de cada teste da classe que a utiliza.
 */
trait AutenticadoComSanctum
{
    protected User $usuario_autenticado;
    protected string $senha_padrao = '123456789';

    /**
     * Executa antes de cada teste, criando e autenticando usuário.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->usuario_autenticado = User::factory()->create([
            'password' => bcrypt($this->senha_padrao),
        ]);

        Sanctum::actingAs($this->usuario_autenticado, ['*']);
    }
}
