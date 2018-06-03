@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                  Band/Artit
                  @if (Auth::user()->permission != 'public')
                    <a href="new-band-artist" class="pull-right"><button class="btn btn-sm btn-primary pull-right">Add Band/Album</button></a>
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
                        <td>Name</td>
                        <td>Genre</td>
                        <td>Description</td>
                        @if (Auth::user()->permission != 'public')
                          <td>Action</td>
                        @endif
                      </tr>
                      @foreach ($bandsArtists as $bandArtist)
                        <tr>
                          <td>{{$bandArtist->name}}</td>
                          <td>{{$bandArtist->genre}}</td>
                          <td>{{$bandArtist->description}}</td>
                          @if (Auth::user()->permission != 'public')
                            <td>
                              <form method="GET" action="{{ url('edit-band-artist/'.$bandArtist->id) }}" class="pull-left">
                                <button type='submit' class="edit-icon"><i class="fa fa-pencil-square-o"></i></button>
                              </form>
                              <a class="btnwaves-effect waves-light remove-record remove-icon" data-toggle="modal" data-url="{{ url('band-artist', ['id' => $bandArtist->id]) }}" data-id="{{$bandArtist->id}}" data-target="#custom-width-modal"><i class="fa fa-trash"></i></a>
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
                    <label>If you delete band/artist the albums and songs this band/artist there are deleted too</label><br/>
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
