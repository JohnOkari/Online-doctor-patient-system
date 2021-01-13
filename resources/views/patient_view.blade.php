@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-heading">
                    <h2><b>{{$user->name}}</b></h2>
                </div>
                <div class="card-body">
                    <h5>Email</h5>
                    <p>{{$user->email}}</p>
                    <h5>Address</h5>
                    <p>{{$user->Address}}</p>
                    <h5>Phone</h5>
                    <p>{{$user->phone}}</p>
                </div>
            </div>
            <div class="card">
                <div class="card-heading"><h4 class="text-center padded-small">History</h4></div>
                <div class="card-body">
                    @foreach ($user->data as $item)
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <b>Symptoms</b>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$item->symptoms}}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <b>Diagnosis</b>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$item->diagnosis}}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <b>Drugs</b>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$item->drugs}}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <b>Date</b>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$item->created}}</p>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">

                <div class="card-heading text-center">{{('Appointmaents')}}</div>
                <div class="card-body">
                    @if (!empty($user->bookings))
                    <table class="table table-responsive table-bordered">
                        <thead>
                            <th></th>
                            <th>Doctor</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Condition</th>
                        </thead>
                        <td>
                            @php
                                $i=1;
                            @endphp
                            @foreach ($user->bookings as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{DB::table('users')->where('id',$item->doctor_id)->first()->name}}</td>
                                    <td>{{$item->date}}</td>
                                    <td>{{$item->time}}</td>
                                    <td>{{$item->condtion}}</td>
                                </tr>
                            @endforeach
                        </td>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
