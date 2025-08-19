<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Buku;
use App\Models\Pinjam;
use App\Models\Pinjaman;

class PinjamanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pinjaman::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'pinjam_id' => Pinjam::factory(),
            'buku_id' => Buku::factory(),
        ];
    }
}
