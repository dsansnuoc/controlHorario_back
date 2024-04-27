<?php

namespace Database\Factories;

use App\Models\Organizacion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organizacion>
 */
class OrganizacionFactory extends Factory
{

    //protected $model = Organizacion::class;
    //protected $table = 'organizacion';

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'nif' => $this->faker->unique()->randomNumber(8),
            'email' => $this->faker->unique()->safeEmail,
            'conection' => $this->faker->word,
            'smtpPort' => $this->faker->numberBetween(1, 65535),
            'smtpUser' => $this->faker->userName,
            'smtpPassword' => $this->faker->password,
            'smtpServer' => $this->faker->domainName,
            'activate' => $this->faker->boolean,
        ];
    }
}