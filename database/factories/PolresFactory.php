<?php

namespace Database\Factories;

use App\Models\Polres;
use Illuminate\Database\Eloquent\Factories\Factory;

class PolresFactory extends Factory
{
    protected $model = Polres::class;

    public function definition(): array
    {
        return [
            'nama_polres' => 'Polres ' . $this->faker->city(),
            'wilayah'     => 'Kabupaten ' . $this->faker->city(),
        ];
    }
}
