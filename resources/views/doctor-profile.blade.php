@extends('layouts.app')


@section('content')
<br>
<br>
<br>
<br>
<div class="banner" id="home">
	<div class="layer">
		<div class="container">
			<div class="banner-text-agile">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-heading text-center"><h4 class="card-title">Dr. {{ $doctor->name }}</h4></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{asset('images/'.$doctor->specialty->image)}}" alt="" width="200px" height="220px" style="border-radius: 50%;">
                                    </div>
                                    <div class="col-md-8">
                                        <p><b>{{$doctor->specialty->name}}</b></p>
                                        <p class="card-text">{{$doctor->specialty->description}}</p>
                                        <h6>{{$doctor->specialty->hospital}}</h6>

                                        <p><b>Tel: </b>{{$doctor->phone}}</p>
                                        <div class="card-footer">
                                            <p>{{$doctor->email}}</p>
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
                        <div class="comment-top">
                            <h4>Leave a review</h4>
                            <div class="comment-bottom">
                                <form action="{{url('comment/'.$doctor->id)}}" method="POST">
                                    @csrf
                                    <textarea class="form-control form-control" name="comment" placeholder="Message..." required=""></textarea>
                                    <button type="submit" class="btn btn-primary btn-sm submit">submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Doctor schedule</h4>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>

@endsection
