<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\BandArtist;
use App\Album;
use App\Song;

class BandArtistController extends Controller
{
    public function viewBandArtistAdd()
    {
      return view('band-artist');
    }

    public function viewBandArtistEdit($id)
    {
      $bandArtist = $this->show($id);
      return view('band-artist', ['bandArtist' => $bandArtist]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bandsArtists =  BandArtist::orderBy('name')->get();
        return view('list-band-artist', ['bandsArtists' => $bandsArtists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input();
        $validator = $this->validator($data);

        if ($validator->fails())
    		{
    			return redirect('new-band-artist')->withErrors($validator->messages());
    		}

        $bandArtist = BandArtist::create([
            'name' => $data['name'],
            'genre' => $data['genre'],
            'description' => $data['description'],
        ]);

        return redirect('/band-artist');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return BandArtist::where('id', '=', $id)
                   ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $bandArtist = BandArtist::find($id);
      $data = $request->input();

      $validator = $this->validator($data);
      if ($validator->fails())
      {
        return redirect('new-band-artist')->withErrors($validator->messages());
      }

      $bandArtist->name = $data["name"];
      $bandArtist->genre = $data["genre"];
      $bandArtist->description = $data["description"];
      $bandArtist->save();

      return redirect('band-artist');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $bandArtist = $this->show($id);

      $album = new Album;
      $results = $album->getAllAlbumsThisBandOrArtist($id);

      foreach ($results as $value) {
        $songs = Song::where('album', $value->id)->delete();
      }

      $albumsDeleted = Album::where('band_artist', $id)->delete();

      $bandArtist->delete();

      return redirect('band-artist');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
    }
}
