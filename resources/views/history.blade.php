@extends('layouts.app')


@section('content')
<br>
<br>
<br>
<br>
<div class="container">
    <div class="banner-text-agile">
        <div class="row">
            <div class="col-md-12">
                @for ($i = 0; $i < count($bookings); $i++)
                <div class="card" style="margin-bottom: 1em;padding: 1em;">
                    <p class="card-text">{{$bookings[$i]['condition']}}</p>
                    <i class="text text-sm text-right"> {{date('M j, Y', strtotime($bookings[$i]['created_at']))}}</i>
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
</div>

</div>

</div>
@endsection
