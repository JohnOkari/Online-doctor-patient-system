@extends('layouts.app')

@section('content')
<br>
<br>
<br>
<div class="container banner-text-agile">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card padded-small"  style="width: 38rem;">
                <h5 class="card-title text-center">{{$patient->name}}</h5>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <p class="card-text">{{$booking->condition}}</p>
                        </div>
                    </div>

                </div>
              </div>
        </div>
        <div class="col-md-5">
            <div class="card">
               <div class="card-header" style="padding:.8em;">
                   <h4><strong>{{('Reschedule Appointment')}}</strong></h4>
               </div>
               <div class="card-body">
                   @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get("success") }}
                    </div>
                   @endif
                   @if ($errors->any())
                   <div class="alert-danger">
                       @foreach ($errors as $item)
                        <p>{{$item}}</p>
                       @endforeach
                   </div>

                   @endif
                   <div class="form-appointment">
                       <form action="{{url('appointment-update')}}" method="POST">
                        @csrf
                       <input type="hidden" name="appointment_id" value="{{$booking->id}}" id="appointment_id">
                        <div class="form-group">
                            <label for="specs">{{ __('Date') }}</label>
                            <div class="col-md-12">
                                <div class="input-group date">
                                    <input type="date" class="form-control datepicker @error('date') is-invalid @enderror" name="date" value="{{$booking->date}}">
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
                                    <input type="time" class="form-control datepicker @error('time') is-invalid @enderror" name="time" value="{{$booking->time}}">
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
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('update') }}
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
<br><br>
@endsection
