@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                  Album
                  @if (Auth::user()->permission != 'public')
                    <a href="new-album" class="pull-right"><button class="btn btn-sm btn-primary pull-right">Add Album</button></a>
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
                        <td>Image</td>
                        <td>Band/Artist</td>
                        <td>Name</td>
                        <td>Year</td>
                        <td>Songs</td>
                        @if (Auth::user()->permission != 'public')
                          <td>Action</td>
                        @endif
                      </tr>
                      @foreach ($albums as $album)
                        <tr>
                          <td>
                            @if($album->img)
                              <img class="img-view" src="/storage/app/images/{{$album->img}}"/>
                            @endif
                          </td>
                          <td>{{$album->name_band_artist}}</td>
                          <td>{{$album->name}}</td>
                          <td>{{$album->year}}</td>
                          <td><a href="song/{{$album->id}}">View Song</a></td>
                          @if (Auth::user()->permission != 'public')
                            <td>
                              <form method="GET" action="{{ url('edit-album/'.$album->id) }}" class="pull-left">
                                <button type='submit' class="edit-icon"><i class="fa fa-pencil-square-o"></i></button>
                              </form>
                              <a class="btnwaves-effect waves-light remove-record remove-icon" data-toggle="modal" data-url="{{ url('album', ['id' => $album->id]) }}" data-id="{{$album->id}}" data-target="#custom-width-modal"><i class="fa fa-trash"></i></a>
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
                    <h4 class="modal-title" id="custom-width-modalLabel">Delete Album</h4>
                </div>
                <div class="modal-body">
                    <label>If you delete album the songs this album there are deleted too</label><br/>
                    <label>Want you sure delete this Album?</label>
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
