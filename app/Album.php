<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Album extends Model
{
    protected $table = 'public.album';

    protected $fillable = [
        'band_artist', 'name', 'year', 'img'
    ];

    public function getAllAlbumsThisBandOrArtist($id){
        $results = DB::select('SELECT id FROM public.album WHERE band_artist = ?', [$id]);

        return $results;
    }

    public function getAlbumWithBandAlbum(){
      $results = DB::select('SELECT A.*, BA.name AS name_band_artist
        FROM public.album AS A JOIN public.band_artist AS BA ON A.band_artist = BA.id
        ORDER BY A.name');

      return $results;
    }
}
