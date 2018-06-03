<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function search(Request $request){
      $data = $request->input();
      if($data['search']){
        $user = new User;
        $result = $user->searchByName($data['search']);

        return view('home', ['responseSearch' => $result]);
      } else {
        return view('home', ['responseSearch' => []]);
      }
    }
}
