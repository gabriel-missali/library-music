@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                  <div class="row col-md-6 col-5 pull-left">
                    Library Music
                  </div>
                  <div class="col-md-6 col-7 pull-right no-padding">
                    <div class="form-group">
                      <form method="GET" action="{{ url('search') }}">
                        <div class="col-md-1 col-3 pull-right btn-search">
                          <button type='submit' class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                        <div class="col-md-5 col-9 pull-right input-search">
                          <input id="search" type="text" class="form-control" name="search" placeholder="Search"/>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>
                      <a href="band-artist">View Band/Artist</a>
                    </p>
                    <p>
                      <a href="album">View Album</a>
                    </p>
                    @if(isset($responseSearch))
                      <div>
                        <h4 class="title-search">Search result</h4>
                        @foreach($responseSearch as $key => $results)
                          @if($key == 'band_artist' && $results)
                            <div class="col-md-12 no-padding-mobile">
                              <h5>Band/Artist</h5>
                              <div class="col-md-12 no-padding-mobile">
                                <table class="table table-bordered table-striped table-user">
                                  <tr>
                                    <td>Image</td>
                                    <td>Name</td>
                                    <td>Genre</td>
                                    <td>Description</td>
                                  </tr>
                                  @foreach($results as $value)
                                    <tr>
                                      <td>
                                        @if($value->img)
                                          <img class="img-view" src="/storage/app/images/{{$value->img}}"/>
                                        @endif
                                      </td>
                                      <td>{{$value->name}}</td>
                                      <td>{{$value->genre}}</td>
                                      <td>{{$value->description}}</td>
                                    </tr>
                                  @endforeach
                                </table>
                              </div>
                            </div>
                          @endif
                          @if($key == 'album' && $results)
                            <div class="col-md-12 no-padding-mobile">
                              <h5>Album</h5>
                              <div class="col-md-12 no-padding-mobile">
                                <table class="table table-bordered table-striped table-user">
                                  <tr>
                                    <td>Image</td>
                                    <td>Band/Artist</td>
                                    <td>Name</td>
                                    <td>Year</td>
                                  </tr>
                                  @foreach($results as $value)
                                    <tr>
                                      <td>
                                        @if($value->img)
                                          <img class="img-view" src="/storage/app/images/{{$value->img}}"/>
                                        @endif
                                      </td>
                                      <td>{{$value->name_band_artist}}</td>
                                      <td>{{$value->name}}</td>
                                      <td>{{$value->year}}</td>
                                    </tr>
                                  @endforeach
                                </table>
                              </div>
                            </div>
                          @endif
                          @if($key == 'song' && $results)
                            <div class="col-md-12 no-padding-mobile">
                              <h5>Song</h5>
                              <div class="col-md-12 no-padding-mobile">
                                <table class="table table-bordered table-striped table-user">
                                  <tr>
                                    <td>Name</td>
                                    <td>Duration</td>
                                    <td>Composer</td>
                                    <td>Order number</td>
                                    <td>Album</td>
                                  </tr>
                                  @foreach($results as $value)
                                    <tr>
                                      <td>{{$value->name}}</td>
                                      <td>{{$value->duration}}</td>
                                      <td>{{$value->composer}}</td>
                                      <td>{{$value->order_number}}</td>
                                      <td>{{$value->name_album}}</td>
                                    </tr>
                                  @endforeach
                                </table>
                              </div>
                            </div>
                          @endif
                        @endforeach
                        @if(count($responseSearch) == 0)
                        <div class="col-md-12">
                          <label>No results</label>
                        </div>
                        @endif
                      </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
