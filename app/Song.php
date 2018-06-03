<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Song extends Model
{
    protected $table = 'public.song';

    protected $fillable = [
        'name', 'duration', 'composer', 'order_number', 'album'
    ];

    public function getAlbumWithSong($id){
      $results = DB::select('SELECT S.*, A.id AS id_album, A.name AS name_album, A.year AS year_album, band_artist
        FROM public.song AS S JOIN public.album AS A ON A.id = S.album
        WHERE A.id = ? ORDER BY S.order_number',[$id]);

      return $results;
    }
}
