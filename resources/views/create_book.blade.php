@extends('layouts.app')

@section('content')
<br>
<br>
<br>
<br>
<div class="container banner-text-agile">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card" >
                <div class="card-header bg-white text-center" style="padding: .5em;">
                    <h4><a href="{{url('doctor-profile/'.$user->id)}}">Dr. {{$user->name}}</a></h4>
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{asset('images/'.$user->specialty->image)}}" alt="{{$user->name}}" width="200px" height="220px" style="border-radius: 50%;">
                        </div>
                        <div class="col-md-8">
                            <h4><strong>{{$user->specialty->name}}</strong></h4>
                            <p class="card-text">{{$user->specialty->description}}</p>
                            <h6><strong>{{$user->specialty->hospital}}</strong></h6>
                            <p><b>Tel: </b>{{$user->phone}}</p>
                        </div>
                    </div>
                </div>
              </div>
        </div>
        <div class="col-md-5">
            <div class="card">
               <div class="card-header bg-white text-center" style="padding: 0.5em;">
                   <h4>{{('Book Appointment')}}</h4>
               </div>
               <div class="card-body">
                   @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                   @endif
                   @if ($errors->any())
                       <div class="alert alert-danger">
                           @foreach ($errors->all() as $item)
                           <p><i class="fa fa-warning"></i>&nbsp;{{$item}}</p>
                           @endforeach
                       </div>
                   @endif
                   <div class="form-appointment">
                       <form action="{{url('appointment/'.$user->id)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="specs">{{ __('Date') }}</label>

                            <div class="col-md-12">
                                <div class="input-group date">
                                    <input type="text" data-date="" class="form-control datepicker @error('date') is-invalid @enderror" name="date" id="dp1">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="specs">{{ __('Time') }}</label>

                            <div class="col-md-12">
                                <div class="input-group date">
                                    <input type="time" class="form-control datepicker @error('time') is-invalid @enderror" name="time">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>

                                @error('time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="condition">{{ __('Condition') }}</label>

                            <div class="col-md-12">
                                <textarea name="condition" id="condition" class="form-control @error('condition') is-invalid @enderror"></textarea>

                                @error('condition')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('book') }}
                                </button>
                            </div>
                        </div>
                        </form>
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
