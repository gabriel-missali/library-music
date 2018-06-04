@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                  @if (isset($bandArtist))
                    Edit Album
                  @else
                    New Album
                  @endif
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (!isset($album))
                      <form method="POST" action="{{ url('album') }}" enctype="multipart/form-data">
                      @csrf
                    @else
                      <form method="POST" action="{{ url('album', ['id' => $album->id]) }}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                    @endif

                      <div class="form-group row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Band/Artist') }}</label>

                          <div class="col-md-6">
                              <select id="band_artist" type="text" class="form-control{{ $errors->has('band_artist') ? ' is-invalid' : '' }}" name="band_artist" value="{{ old('band_artist') }}" required autofocus>
                                @foreach ($bandsArtists as $bandArtist)
                                  <option value="{{$bandArtist->id}}" @if (isset($album) && $album->band_artist == $bandArtist->id) selected="selected" @endif>{{$bandArtist->name}}</option>
                                @endforeach
                              </select>

                              @if ($errors->has('band_artist'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('band_artist') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                          <div class="col-md-6">
                              <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ isset($album) ? $album->name : old('name') }}" required autofocus>

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
                                @if(isset($album) && $album->img)
                                  <input class="info-img" type="text" name="old_picture" value="{{$album->img}}" readonly="readonly">
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
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Year') }}</label>

                          <div class="col-md-6">
                              <input id="genre" type="number" class="form-control{{ $errors->has('year') ? ' is-invalid' : '' }}" name="year" value="{{ isset($album) ? $album->year : old('year') }}" required autofocus>

                              @if ($errors->has('year'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('year') }}</strong>
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
