<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use app\User;

class UserController extends Controller
{
    public function viewUserAdd()
    {
        return view('user');
    }

    public function viewUserEdit($id)
    {
        $user = $this->show($id);
        return view('user', ['user' => $user]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =  User::orderBy('id')->get();
        return view('listUsers', ['users' => $users]);
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
    			return redirect('/new-user')->withErrors($validator->messages());
    		}

        $file = $request->file('picture');
        if($file){
          $fileName = time().'_'.$file->getClientOriginalName();
          $file->storeAs('images',$fileName);
        } else {
          $fileName = null;
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'permission' => $data['permission'],
            'password' => Hash::make($data['password']),
            'img' => $fileName,
        ]);

        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return User::where('id', '=', $id)
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
        $user = User::find($id);
        $data = $request->input();

        $validator = $this->validatorEdit($data);
        if ($validator->fails())
    		{
    			return redirect('edit-user/'.$id)->withErrors($validator->messages());
    		}

        $file = $request->file('picture');
        if($file){
          $fileName = time().'_'.$file->getClientOriginalName();
          $file->storeAs('images',$fileName);
        } else {
          $fileName = $data['old_picture'];
        }

        $user->name = $data["name"];
        $user->email = $data["email"];
        $user->permission = $data["permission"];
        $user->img = $fileName;
        $response = $user->save();

        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->show($id);
        $response = $user->delete();

        return redirect('/users');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'permission' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    protected function validatorEdit(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'permission' => 'required|string|max:255',
            'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }
}
