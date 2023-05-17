<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'review',
        'rate',
        'user_id',
        'movie_id'
    ];


    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }


    public function movie() {
        return $this->belongsTo(Movie::class);
    }


    public function user() {
        return $this->belongsTo(User::class);
    }
}
