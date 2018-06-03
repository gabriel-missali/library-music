@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                  @if (isset($song))
                    Edit Song
                  @else
                    New Song
                  @endif
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (!isset($song))
                      <form method="POST" action="{{ url('song') }}">
                        <input type="hidden" name="album" value="{{$idAlbum}}" />
                      @csrf
                    @else
                      <form method="POST" action="{{ url('song', ['id' => $song->id]) }}">
                        <input type="hidden" name="_method" value="put" />
                        <input type="hidden" name="album" value="{{$song->album}}" />
                        {!! csrf_field() !!}
                    @endif

                      <div class="form-group row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                          <div class="col-md-6">
                              <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ isset($song) ? $song->name : old('name') }}" required autofocus>

                              @if ($errors->has('name'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Duration') }}</label>

                          <div class="col-md-6">
                              <input id="duration" type="number" step="0.01" class="form-control{{ $errors->has('duration') ? ' is-invalid' : '' }}" name="duration" value="{{ isset($song) ? $song->duration : old('duration') }}" required autofocus>

                              @if ($errors->has('duration'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('duration') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Composer') }}</label>

                          <div class="col-md-6">
                              <input id="composer" type="text" class="form-control{{ $errors->has('composer') ? ' is-invalid' : '' }}" name="composer" value="{{ isset($song) ? $song->composer : old('composer') }}" required autofocus>

                              @if ($errors->has('composer'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('composer') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Order Number') }}</label>

                          <div class="col-md-6">
                              <input id="order_number" type="number" class="form-control{{ $errors->has('order_number') ? ' is-invalid' : '' }}" name="order_number" value="{{ isset($song) ? $song->order_number : old('order_number') }}" required autofocus>

                              @if ($errors->has('order_number'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('duration') }}</strong>
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
