<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    // use HasFactory;

    protected $fillable = [
        'genre_id', 'judul', 'slug', 'ringkasan', 'tahun', 'poster',
        'tipe', 'jumlah_episode', 'durasi', 'link'
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function ulasans()
    {
        return $this->hasMany(Ulasan::class);
    }
}

