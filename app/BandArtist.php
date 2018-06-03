<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BandArtist extends Model
{
    protected $table = 'public.band_artist';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'genre', 'description'
        // 'name', 'image', 'genre', 'description'
    ];
}
