@extends('layouts.app')

@section('content')
<br>
<br>
<br>
<br>
<div class="container banner-text-agile">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-heading"><h4 class="text-center padded-small">{{$patient->name}} illness </h4></div>
                <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">{{$condition->condition}}</p>
                                <h4 class="text-center">Prescription</h4>
                                @foreach ($prescription as $item)
                                <p class="card-text"><strong>Symptoms:   </strong>  {{$item["symptoms"]}}</p>
                                <p class="card-text"><strong>Diagnosis:  </strong>  {{$item["diagnosis"]}}</p>
                                <p class="card-text"><strong>Treatment:  </strong>{{$item["drugs"]}}</p>
                                <p class="card-link pull-right">{{ date('M j, F', strtotime($item['created_at'])) }}</p>
                                @endforeach
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-heading text-center">{{('Pescription')}}</div>
                <div class="card-body">
                    <div class="form-appointment">
                        <form action="{{url('doctor/pres/'.$condition->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="symptoms">{{ __('Symptoms') }}</label>

                                <div class="col-md-12">
                                    <div class="input-group">
                                        <textarea type="text" class="form-control @error('symptoms') is-invalid @enderror" name="symptoms" value="{{old('symptoms')}}" required></textarea>
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>

                                    @error('symptoms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="diag">{{ __('Diagnosis') }}</label>

                                <div class="col-md-12">
                                    <div class="input-group diag" data-provide="">
                                        <textarea type="text" class="form-control @error('diag') is-invalid @enderror" name="diag" value="{{old('diag')}}" required></textarea>
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>

                                    @error('diag')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="results">{{ __('Results') }}</label>

                                <div class="col-md-12">
                                    <div class="input-group" data-provide="">
                                        <textarea type="text" class="form-control @error('results') is-invalid @enderror" name="results" value="{{old('results')}}" required></textarea>
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>

                                    @error('results')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="drug">{{ __('Drug') }}</label>

                                <div class="col-md-12">
                                    <textarea id="drug" type="text" class="form-control @error('drug') is-invalid @enderror" name="drug" value="{{ old('drug') }}" autocomplete="drug" required></textarea>

                                    @error('drug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="follow">{{ __('Follow up') }}</label>

                                <div class="col-md-12">
                                    <select name="follow" id="follow" class="form-control">Follow up
                                        <option>Choose</option>
                                        <option value="true">True</option>
                                        <option value="na">N/A</option>
                                    </select>

                                    @error('follow')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group next_meet">
                                <label for="next_meet">{{ __('Next meeting') }}</label>

                                <div class="col-md-12">
                                    <input type="text" class="form-control @error('next_meet') is-invalid @enderror" name="next_meet" value="{{ old('next_meet') }}" autocomplete="next_meet" id="dp1">

                                    @error('next_meet')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="files">{{ __('Files') }}</label>

                                <div class="col-md-12">
                                    <input id="files" type="file" class="form-control @error('files') is-invalid @enderror" name="img" value="{{ old('files') }}" autocomplete="files">

                                    @error('files')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('prescribe') }}
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
