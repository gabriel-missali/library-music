@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                  Song
                  @if (Auth::user()->permission != 'public')
                    <a href="/public/new-song/{{$idAlbum}}" class="pull-right"><button class="btn btn-sm btn-primary pull-right">Add Song</button></a>
                  @endif
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-bordered table-striped table-user">
                      <tr>
                        <td>Album</td>
                        <td>Name</td>
                        <td>Duration</td>
                        <td>Composer</td>
                        <td>Order number</td>
                        @if (Auth::user()->permission != 'public')
                          <td>Action</td>
                        @endif
                      </tr>
                      @foreach ($songsAlbum as $songAlbum)
                        <tr>
                          <td>{{$songAlbum->name_album}}</td>
                          <td>{{$songAlbum->name}}</td>
                          <td>{{$songAlbum->duration}}</td>
                          <td>{{$songAlbum->composer}}</td>
                          <td>{{$songAlbum->order_number}}</td>
                          @if (Auth::user()->permission != 'public')
                            <td>
                              <form method="GET" action="{{ url('edit-song', ['id' => $songAlbum->id]) }}" class="pull-left">
                                <button type='submit' class="edit-icon"><i class="fa fa-pencil-square-o"></i></button>
                              </form>
                              <a class="btnwaves-effect waves-light remove-record-song remove-icon" data-toggle="modal" data-url="{{ url('song', ['id' => $songAlbum->id]) }}" data-id="{{$songAlbum->id}}" data-album="{{$songAlbum->album}}" data-target="#custom-width-modal"><i class="fa fa-trash"></i></a>
                            </td>
                          @endif
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
                    <h4 class="modal-title" id="custom-width-modalLabel">Delete Song</h4>
                </div>
                <div class="modal-body">
                    <label>Want you sure delete this Song?</label>
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
