<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Pengunjung;

class PengunjungFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pengunjung::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word(),
            'instansi' => $this->faker->word(),
            'alamat' => $this->faker->word(),
            'jenis_kelamin' => $this->faker->word(),
            'tujuan' => $this->faker->word(),
            'tanggal' => $this->faker->date(),
        ];
    }
}
