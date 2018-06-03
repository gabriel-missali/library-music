<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Song;
use App\Album;

class SongController extends Controller
{
    public function viewSongAdd($id)
    {
      return view('song', ['idAlbum' => $id]);
    }

    public function viewSongEdit($id)
    {
      $song = Song::find($id);
      return view('song', ['song' => $song]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //
      return redirect('album');
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
          return redirect('new-song/'.$data['album'])->withErrors($validator->messages());
        }

        $song = Song::create([
            'name' => $data['name'],
            'duration' => $data['duration'],
            'composer' => $data['composer'],
            'order_number' => $data['order_number'],
            'album' => $data['album'],
        ]);

        return redirect('song/'.$data['album']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $song = new Song;
      $result = $song->getAlbumWithSong($id);
      return view('list-songs', ['songsAlbum' => $result, 'idAlbum' => $id]);
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
        $song = Song::find($id);
        $data = $request->input();

        $validator = $this->validator($data);
        if ($validator->fails())
        {
          return redirect('edit-song'.$data['album'])->withErrors($validator->messages());
        }

        $song->name = $data["name"];
        $song->duration = $data["duration"];
        $song->composer = $data["composer"];
        $song->order_number = $data["order_number"];
        $song->save();

        return redirect('song/'.$data['album']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->input();
        $song = Song::find($id);
        $song->delete();

        return redirect('song/'.$data['album']);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'duration' => 'required|numeric',
            'composer' => 'required|string|max:255',
            'order_number' => 'required|integer',
            'album' => 'required|integer',
        ]);
    }
}
