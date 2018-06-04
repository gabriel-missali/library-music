<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'permission', 'img'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function searchByName($search){
        $returnSearch = array();
        $bandArtist = DB::select("SELECT * FROM public.band_artist
          WHERE LOWER(name) LIKE LOWER('%".$search."%')
          OR LOWER(genre) LIKE LOWER('%".$search."%')
          OR LOWER(description) LIKE LOWER('%".$search."%')
        ");
        $returnSearch['band_artist'] = $bandArtist;

        $album = DB::select("SELECT A.*, BA.name AS name_band_artist
          FROM public.album AS A JOIN public.band_artist AS BA ON A.band_artist = BA.id
          WHERE LOWER(A.name) LIKE LOWER('%".$search."%') ORDER BY A.name
        ");
        $returnSearch['album'] = $album;

        $song = DB::select("SELECT S.*, A.id AS id_album, A.name AS name_album
          FROM public.song AS S JOIN public.album AS A ON A.id = S.album
          WHERE LOWER(S.name) LIKE LOWER('%".$search."%')
          OR LOWER(S.composer) LIKE LOWER('%".$search."%')
          ORDER BY S.order_number
        ");
        $returnSearch['song'] = $song;

        return $returnSearch;
    }
}
