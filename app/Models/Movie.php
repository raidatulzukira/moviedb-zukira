<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movie extends Model
{
    /** @use HasFactory<\Database\Factories\MovieFactory> */
    use HasFactory;

    //Tambahan indri
    // Tambahkan semua field yang bisa diisi massal
    protected $fillable = [
        'title',
        'synopsis',      // sesuaikan dengan field di migration (kamu pakai 'synopsis' bukan 'description')
        'category_id',
        'year',
        'actors',
        'cover_image',
        'slug'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    //sampai sini



}
