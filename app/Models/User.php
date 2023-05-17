<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'slug',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function setTitleAttribute($value) {
        $this->attributes['username'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }


    public function movies() {
        return $this->hasMany(Movie::class);
    }


    public function favoriteMovies() {
        return $this->belongsToMany(Movie::class, 'favorites', 'user_id', 'movie_id');
    }  

    
    public function role() {
        return $this->hasOne(Role::class);
    }
}
