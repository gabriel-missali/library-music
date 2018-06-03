@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                  @if (isset($user))
                    Edit User
                  @else
                    New User
                  @endif
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (!isset($user))
                      <form method="POST" action="{{ url('user') }}">
                      @csrf
                    @else
                      <form method="POST" action="{{ url('user', ['id' => $user->id]) }}">
                        <input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                    @endif

                      <div class="form-group row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                          <div class="col-md-6">
                              <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ isset($user) ? $user->name : old('name') }}" required autofocus>

                              @if ($errors->has('name'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                          <div class="col-md-6">
                              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ isset($user) ? $user->email : old('email') }}" required>

                              @if ($errors->has('email'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Permission') }}</label>

                          <div class="col-md-6">
                              <select id="permission" type="text" class="form-control{{ $errors->has('permission') ? ' is-invalid' : '' }}" name="permission" value="{{ old('permission') }}" required autofocus>
                                <option value="admin" @if (isset($user) && $user->permission == 'admin') selected="selected" @endif>Admin</option>
                                <option value="user" @if (isset($user) && $user->permission == 'user') selected="selected" @endif>User</option>
                                <option value="public" @if (isset($user) && $user->permission == 'admin') selected="selected" @endif>Public</option>
                              </select>
                              @if ($errors->has('permission'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('permission') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      @if (!isset($user))
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      @endif

                      @if (!isset($user))
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password-confirm'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password-confirm') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      @endif

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
