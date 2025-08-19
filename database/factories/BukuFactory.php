<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Rak;

class BukuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Buku::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'kategori_id' => Kategori::factory(),
            'rak_id' => Rak::factory(),
            'sampul' => $this->faker->word(),
            'isbn' => $this->faker->word(),
            'judul' => $this->faker->word(),
            'penerbit' => $this->faker->word(),
            'penulis' => $this->faker->word(),
            'tahun' => $this->faker->numberBetween(-10000, 10000),
            'isi' => $this->faker->numberBetween(-10000, 10000),
            'jumlah' => $this->faker->numberBetween(-10000, 10000),
            'tanggal_masuk' => $this->faker->date(),
            'no_induk' => $this->faker->word(),
            'rf_id' => $this->faker->word(),
            'no_barcode' => $this->faker->word(),
            'peroleh' => $this->faker->word(),
        ];
    }
}
