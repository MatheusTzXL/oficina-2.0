<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 *
 * Fábrica para criação de instâncias de usuários para testes ou populamento de banco de dados.
 */
class UserFactory extends Factory
{
    /**
     * A senha atual sendo utilizada pela fábrica.
     * 
     * @var string|null
     */
    protected static ?string $password;

    /**
     * Define o estado padrão do modelo.
     *
     * @return array<string, mixed> Um array associativo com os atributos do modelo User.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indica que o endereço de e-mail do modelo deve ser não verificado.
     *
     * @return static Instância da fábrica com o estado de e-mail não verificado.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
