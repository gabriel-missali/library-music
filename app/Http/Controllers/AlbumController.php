<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Song;
use App\Album;
use App\BandArtist;

class AlbumController extends Controller
{
    public function viewAlbumAdd()
    {
      $bandsArtists =  BandArtist::orderBy('name')->get();
      return view('album', ['bandsArtists' => $bandsArtists]);
    }

    public function viewAlbumEdit($id)
    {
      $album = $this->show($id);
      $bandsArtists =  BandArtist::orderBy('name')->get();
      return view('album', ['album' => $album, 'bandsArtists' => $bandsArtists]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $album = new Album;
      $result = $album->getAlbumWithBandAlbum();
      return view('listAlbums', ['albums' => $result]);
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
          return redirect('new-album')->withErrors($validator->messages());
        }

        $file = $request->file('picture');
        if($file){
          $fileName = time().'_'.$file->getClientOriginalName();
          $file->storeAs('images',$fileName);
        } else {
          $fileName = null;
        }

        $album = Album::create([
            'band_artist' => $data['band_artist'],
            'name' => $data['name'],
            'year' => $data['year'],
            'img' => $fileName,
        ]);

        return redirect('album');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return Album::where('id', '=', $id)
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
        $album = Album::find($id);
        $data = $request->input();

        $validator = $this->validator($data);
        if ($validator->fails())
        {
          return redirect('edit-album')->withErrors($validator->messages());
        }

        $file = $request->file('picture');
        if($file){
          $fileName = time().'_'.$file->getClientOriginalName();
          $file->storeAs('images',$fileName);
        } else {
          $fileName = $data['old_picture'];
        }
        
        $album->band_artist = $data["band_artist"];
        $album->name = $data["name"];
        $album->year = $data["year"];
        $album->img = $fileName;
        $album->save();

        return redirect('album');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $album = Album::find($id);
      $album->delete();

      $songs = Song::where('album', $id)->delete();

      return redirect('album');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'band_artist' => 'required|integer',
            'name' => 'required|string|max:255',
            'year' => 'required|integer',
            'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }
}
