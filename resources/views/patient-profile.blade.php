@extends('layouts.app')


@section('content')
<br>
<br>
<br>
<br>
<div class="container">
    <div class="banner-text-agile">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header bg-white" style="padding: .5em 0em;">
                        <h3 class="card-title text text-bold text-center text-info">{{Auth::user()->name}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{asset('images/avatar.png')}}" alt="" width="150px" height="150px" style="border-radius: 50%;">
                            </div>
                            <div class="col-md-8">
                                <h5 class="tewxt text-bold"><b>Contact information</b></h5>
                                <br>
                                <blockquote class="card-text text-bold"><i class="fa fa-envelope text-primary"></i> &nbsp;&nbsp; {{Auth::user()->email}}</blockquote>
                                <blockquote class="card-text text-bold"><i class="fa fa-phone text-primary"></i> &nbsp;&nbsp; {{Auth::user()->phone}}</blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                {{-- <div class="card">
                    <div class="card-header bg-white">
                        <h3 class="text text-center text-bold text-info" style="padding: .5em;">Patient record</h3>
                    </div>
                    <div class="card-body">
                        @for ($i = 0; $i < count($bookings); $i++)
                       <div class="card" style="margin-bottom: 1em;padding: 1em;">
                            <p class="card-text">{{$bookings[$i]['condition']}}</p>
                            <span class="text txet-right"> {{date('M j, Y', strtotime($bookings[$i]['created_at']))}}</span>
                            @foreach ($bookings[$i]->data as $key => $value)
                            <h3 class="card-title">Treatment</h3>
                            <p class="card-text"><b>Symptoms: </b> {{$value->symptoms}}</p>
                            <p class="card-text"><b>Diagnosis: </b> {{$value->diagnosis}}</p>
                            <p class="card-text"><b>Medicine </b> {{$value->drugs}}</p>
                            @php
                                $doctor =DB::table('users')->where('id',$value->doctor_id)->get()->first();
                            @endphp
                            <p class="card-link">Prescribed by: <a href="{{url("doctor-profile/$doctor->id")}}">Dr. {{$doctor->name}}</a></p>
                            @endforeach
                        </div>
                        @endfor                       
                    </div>
                </div> --}}
            </div>
        </div>
        <br>
        <br>

        {{-- <div class="card">
            <div class="card-header bg-white">
                <h3 class="text text-center text-info" style="padding: 1em;"><strong>My Appointments</strong></h4>
            </div>
            <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                        <p><i class="fa fa-check"></i>{{Session::get('success')}}</p>
                        </div>
                    @endif
                    @if (isset($errrors))
                        <div class="alert alert-danger">
                            @foreach ($errors as $item)
                                <p><i class="fa fa-warning"></i>{{$item}}</p>
                            @endforeach
                        </div>
                    @endif --}}
                {{-- <table id="dataTable">
                    @if(!empty(Auth::user()->role) && Auth::user()->role->name == "patient")
                    <thead>
                        <th>#</th>
                        <th>Doctor</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Condition</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                            @foreach ($bookings as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{DB::table('users')->where('id',$item->doctor_id)->get()->first()->name}}</td>
                                <td>{{date('M j, Y',strtotime($item->date))}}</td>
                                <td>{{$item->time}}</td>
                                <td>{{$item->condition}}</td>
                                <td>{{$item->status}}</td>
                                <td>
                                    <li class="dropdown">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown">Action</a>
                                        <ul class="dropdown-menu" style="padding: 1em;">
                                        <li class="dropdown-item"><a href="#" data-toggle="modal" data-target="#rescheduleAppointment" id="reschedule" data-id="{{$item->id}}">Reschedule</a></li>
                                        <li class="dropdown-item"><a href="#" data-toggle="modal" data-target="#cancelAppointment" data-cid="{{$item->id}}" id="cancelAppointmentButton">Cancel</a></li>
                                        </ul>
                                    </li>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    @endif
                </table> --}}
            {{-- </div>
        </div> --}}
    </div>
</div>

{{-- <div class="modal fade" id="rescheduleAppointment" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="display: inline-block;">
                <h4 class="modal-title float-left" id="modalLabel"><strong>Reschedule</strong></h4>
                <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{url('appointment-update')}}" method="POST" id="rescheduleForm">
                @csrf
                    <input type="hidden" name="appointment_id" value="" id="appointment_id">
                    
                    <div class="form-group">
                        <label for="specs">{{ __('Date') }}</label>

                        <div class="input-group">
                            <input type="date" class="form-control datepicker @error('date') is-invalid @enderror" name="date">
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

                    <div class="form-group">
                        <label for="specs">{{ __('Time') }}</label>

                            <div class="input-group">
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

                    <div class="col-lg-12 text-center">
                        <button class="btn btn-primary btn-sm" type="submit">
                            <i class="fa fa-plus"></i>
                            save
                        </button>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="cancelAppointment" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="display: inline-block;">
                <h4 class="modal-title float-left" id="modalLabel"><strong>Cancel Appointment</strong></h4>
                <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{url('appointment-cancel')}}" method="POST" id="cancel_form">
                @csrf
                    <input type="hidden" name="appointment_id" value="" id="appointment_idc">
                    
                    <div class="form-group">
                        <label for="specs">{{ __('Cancellation remarks') }}</label>

                        <div class="input-group">
                            <textarea name="remarks" id="remarks" class="form-control form-control-sm @error('remarks') is-invalid @enderror"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12 text-center">
                        <button class="btn btn-primary btn-sm" type="submit">
                            <i class="fa fa-plus"></i>
                            save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}



</div>

</div>
@endsection
