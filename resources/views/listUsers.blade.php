@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
          @if (\Session::has('success'))
            <div class="alert alert-success">
              <p>{{ \Session::get('success') }}</p>
            </div><br />
           @endif
            <div class="card">
                <div class="card-header">
                  Users
                  <a href="/public/new-user" class="pull-right"><button class="btn btn-sm btn-primary pull-right">Add User</button></a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-bordered table-striped table-user">
                      <tr>
                        <td>Image</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Permission</td>
                        <td>Action</td>
                      </tr>
                      @foreach ($users as $user)
                        <tr>
                          <td>
                            @if($user->img)
                              <img class="img-view" src="/storage/app/images/{{$user->img}}"/>
                            @endif
                          </td>
                          <td>{{$user->name}}</td>
                          <td>{{$user->email}}</td>
                          <td>{{$user->permission}}</td>
                          <td>
                            <form method="GET" action="{{ url('edit-user/'.$user->id) }}" class="pull-left">
                              <button type='submit' class="edit-icon"><i class="fa fa-pencil-square-o"></i></button>
                            </form>
                            <a class="btnwaves-effect waves-light remove-record remove-icon" data-toggle="modal" data-url="{{ url('user', ['id' => $user->id]) }}" data-id="{{$user->id}}" data-target="#custom-width-modal"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                      @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="" method="POST" class="remove-record-model">
    <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Delete User</h4>
                </div>
                <div class="modal-body">
                    <label>Want you sure delete this User?</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm waves-effect remove-data-from-delete-form" data-dismiss="modal">Close</button>

                    <input type="hidden" name="_method" value="delete" />
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-danger btn-sm waves-effect waves-light">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
