<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * La contraseña que voy a usar por defecto en los usuarios de prueba.
     */
    protected static ?string $password;

    /**
     * Defino los valores por defecto para crear usuarios falsos.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),                              // Nombre aleatorio
            'email' => fake()->unique()->safeEmail(),              // Email único y válido
            'email_verified_at' => now(),                          // Marco el email como verificado
            'password' => static::$password ??= Hash::make('password'), // Contraseña por defecto: "password"
            'remember_token' => Str::random(10),                   // Token aleatorio para "recordarme"
            'career_id' => \App\Models\Career::inRandomOrder()->first()?->id ?? 1, // Cojo una carrera al azar o la 1
            'terms_accepted' => true,                              // Acepto los términos por defecto
        ];
    }

    /**
     * Indico que el email no debe estar verificado (para usuarios sin verificar).
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,   // Pongo la verificación en null
        ]);
    }
}
