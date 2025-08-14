<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use Tests\Traits\AutenticadoComSanctum;
use Tests\TestCase;

class AutenticacaoApiTest extends TestCase
{
    use RefreshDatabase;

    private string $senha_padrao = '123456789';

    protected function setUp(): void
    {
        parent::setUp();

        $this->usuario = User::factory()->create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt($this->senha_padrao),
        ]);
    }

    /** @test */
    public function deve_permitir_login_com_credenciais_validas()
    {
        $payload = [
            'email' => 'admin@gmail.com',
            'password' => $this->senha_padrao,
        ];

        $this->postJson(route('login'), $payload)
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'email_verified_at',
                    'created_at',
                    'updated_at',
                ],
                'token',
            ]);
    }

    /** @test */
    public function deve_negar_login_com_senha_incorreta()
    {
        $payload = [
            'email' => $this->usuario->email,
            'password' => 'senhaErrada',
        ];

        $this->postJson(route('login'), $payload)
            ->assertUnauthorized()
            ->assertJson([
                'message' => 'Email and password don\'t match',
            ]);
    }

    /** @test */
    public function usuario_autenticado_deve_acessar_rota_protegida()
    {
        Sanctum::actingAs($this->usuario, ['*']);

        $this->getJson(route('lojas.index'))
            ->assertOk();
    }
}
