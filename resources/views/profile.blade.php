@extends('layouts.app')


@section('content')
<br>
<br>
<br><br>
<div class="banner" id="home">
	<div class="layer">
		<div class="container">
			<div class="banner-text-agile">
                @if (empty(Auth::user()->role))
                <a href="{{url('update.role')}}" class="btn btn-primary">Update profile</a>

                @elseif (Auth::user()->role->name == 'doctor')
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-white text-center">
                                <h4 style="padding: .5em;">{{ Auth::user()->name }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{asset('images/'.Auth::user()->specialty->image)}}" class="card-img-top" alt="" width="200px" height="230px" style="border-radius: 50%;">
                                        </div>
                                        <div class="col-md-8">
                                            <p><b>{{Auth::user()->specialty->name}}</b></p>
                                            <p class="card-text">{{Auth::user()->specialty->description}}</p>
                                            <h6>{{Auth::user()->specialty->hospital}}</h6>

                                            <p><b>Tel: </b>{{Auth::user()->phone}}</p>
                                            <div class="card-link">
                                                <p>{{Auth::user()->email}}</p>
                                            </div>
                                        </div>
                                </div>

                            </div>
                        </div>
                        <div class="comment-top">

                            <h4>Reviews</h4>
                            @foreach ($comments as $value)
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-sm-0 mt-3">{{ $value['name'] }}</h5>
                                    <p>{{$value['comment']}}</p>

                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                @endif
			</div>
		</div>
	</div>
</div>

@endsection
