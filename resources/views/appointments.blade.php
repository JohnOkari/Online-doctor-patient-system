@extends('layouts.app')


@section('content')
<br>
<br>
<br>
<div class="banner" id="home">
	<div class="layer">
		<div class="container">
			<div class="banner-text-agile">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        <p><i class="fa fa-check">&nbsp;&nbsp;{{Session::get('success')}}</i></p>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                       @foreach ($errors->all() as $item)
                       <p><i class="fa fa-warning">&nbsp;&nbsp;{{$item}}</i></p>
                       @endforeach
                    </div>
                @endif
                @if (empty(Auth::user()->role))
                <a href="{{url('update.role')}}" class="btn btn-primary">Update profile</a>
                @else
                <h1>My appointments</h1>
                <div class="row">
                    <div class="col-md-12">
                    
                        <table id="dataTable">
                            <thead>
                                <th>#</th>
                                @if (!empty(auth()->user()->role))
                                    @if (auth()->user()->role->name === "doctor")
                                        <th>Patient Name</th>
                                    @elseif(auth()->user()->role->name === "patient")
                                        <th>Doctor</th>
                                    @endif
                                @endif
                                <th>Email</th>
                                <th>Phone number</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Condition</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp

                                @foreach ($appointments as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    @if (!empty(auth()->user()->role))
                                        @if (auth()->user()->role->name === "doctor")
                                            <td>{{$item['patient']}}</td>
                                        @elseif(auth()->user()->role->name === "patient")
                                            <td>{{$item['doctor']}}</td>
                                        @endif
                                    @endif
                                    
                                    <td>{{$item['email']}}</td>
                                    <td>{{$item['phone']}}</td>
                                    <td>{{date('M j, F', strtotime($item['date']))}}</td>
                                    <td>{{$item['time']}}</td>
                                    <td>{{$item['condition']}}</td>
                                    <td>{{$item['status']}}</td>
                                    <td>
                                        <li class="dropdown"> <a href="#" data-toggle="dropdown" class="btn btn-primary">Action</a>
                                            <ul class="dropdown-menu">
                                                @if (auth()->user()->role->name === "doctor")
                                                    @if ($item['status'] !== "approved")
                                                    <li class="dropdown-item"><a href="{{url('approve/'.$item['id'])}}">Approve</a></li>
                                                    @endif
                                                    <li class="dropdown-item"><a href="{{ url('doctor/'.$item['id'])}}">Prescribe</a></li>
                                                @endif
                                                <li class="dropdown-item"><a href="#" data-toggle="modal" data-target="#rescheduleAppointment" id="reschedule" data-id="{{$item["id"]}}">Reschedule</a></li>
                                                <li class="dropdown-item"><a href="#" data-toggle="modal" data-target="#cancelAppointment" data-cid="{{$item["id"]}}" id="cancelAppointmentButton">Cancel</a></li>
                                            </ul>
                                        </li>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
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
</div>


<div class="modal fade" id="rescheduleAppointment" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
                            <input type="text" class="form-control datepicker @error('date') is-invalid @enderror" name="date" id="dp1">
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

@endsection
