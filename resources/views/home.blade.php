@extends('layouts.app')


@section('content')
<br>
<br>
<br>
<br>
<div class="container">
    <div class="col-md-12">
    <h2 class="heading text-center mb-sm-5 mb-4">Doctors</h2>
		<div class="row">
            @if (!empty($doctors))
            @foreach ($doctors as $item)
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><a href="{{url('doctor-profile/'.$item->id)}}"><b>Dr. {{$item->name}}</b></a></h4>
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{asset('images/'.$item->specialty->image)}}" class="card-img-top" alt="" width="200px" height="200px" style="border-radius: 50%;">
                            </div>
                            <div class="col-md-8">
                                <p><b>{{$item->specialty->name}}</b></p>
                                <p class="card-text">{{$item->specialty->description}}</p>
                                <h6>{{$item->specialty->hospital}}</h6>

                                <p><b>Tel: </b>{{$item->phone}}</p>
                                <div class="card-link">
                                    @if (auth()->user() && auth()->user()->role !== null && auth()->user()->role->name === "doctor")
                                    @else
                                    <a href="{{url('book/'.$item->id)}}" class="btn btn-primary btn-sm">Book Appointment</a>
                                    <a href="{{url('doctor-profile/'.$item->id)}}" class="btn btn-primary btn-sm">View profile</a>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
    </div>
</div>
</div>
@endsection
