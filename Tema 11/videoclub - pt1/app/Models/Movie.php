<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'movies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'year',
        'director',
        'poster',
        'rented',
        'synopsis'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'rented' => 'boolean',
    ];
}