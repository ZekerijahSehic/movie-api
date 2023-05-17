<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Movie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'release_year',
        'duration_minutes',
        'plot_summary',
        'user_id'
    ];


    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }


    public function posts() {
        return $this->hasMany(Post::class);
    }


    public function user() {
        return $this->belongsTo(User::class);
    }

    
    public function favoritedByUsers() {
        return $this->belongsToMany(User::class, 'favorites', 'movie_id', 'user_id');
    }
}
