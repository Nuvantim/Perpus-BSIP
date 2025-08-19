<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Buku extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kategori_id',
        'rak_id',
        'sampul',
        'isbn',
        'judul',
        'penerbit',
        'penulis',
        'tahun',
        'isi',
        'jumlah',
        'tanggal_masuk',
        'no_induk',
        'rf_id',
        'no_barcode',
        'peroleh',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'kategori_id' => 'integer',
        'rak_id' => 'integer',
        'tanggal_masuk' => 'date',
    ];

    public function rak(): BelongsTo
    {
        return $this->belongsTo(Rak::class);
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }
}
