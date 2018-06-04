@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                  @if (isset($bandArtist))
                    Edit Band/Artist
                  @else
                    New Band/Artist
                  @endif
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (!isset($bandArtist))
                      <form method="POST" action="{{ url('band-artist') }}" enctype="multipart/form-data">
                      @csrf
                    @else
                      <form method="POST" action="{{ url('band-artist', ['id' => $bandArtist->id]) }}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                    @endif

                      <div class="form-group row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                          <div class="col-md-6">
                              <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ isset($bandArtist) ? $bandArtist->name : old('name') }}" required autofocus>

                              @if ($errors->has('name'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                          <div class="col-md-6">
                              <div class="form-group">
                                <input type="file" name="picture" id="picture">
                                @if(isset($bandArtist) && $bandArtist->img)
                                  <input class="info-img" type="text" name="old_picture" value="{{$bandArtist->img}}" readonly="readonly">
                                @endif
                              </div>
                              @if ($errors->has('picture'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('picture') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Genre') }}</label>

                          <div class="col-md-6">
                              <input id="genre" type="text" class="form-control{{ $errors->has('genre') ? ' is-invalid' : '' }}" name="genre" value="{{ isset($bandArtist) ? $bandArtist->genre : old('genre') }}" required autofocus>

                              @if ($errors->has('genre'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('genre') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                          <div class="col-md-6">
                              <textarea id="description" type="text-area" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" required autofocus>@if (isset($bandArtist)){{$bandArtist->description}} @endif</textarea>

                              @if ($errors->has('description'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('description') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row mb-0">
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-success">
                                  {{ __('Save') }}
                              </button>
                          </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
