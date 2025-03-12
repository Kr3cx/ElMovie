<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    // use HasFactory;

    protected $fillable = ['user_id', 'film_id', 'rating', 'review'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($ulasan) {
            $existingReview = Ulasan::where('user_id', $ulasan->user_id)
                ->where('film_id', $ulasan->film_id)
                ->exists();
            
            if ($existingReview) {
                throw new \Exception("Anda sudah memberikan ulasan untuk film ini.");
            }
        });
    }
    
}
