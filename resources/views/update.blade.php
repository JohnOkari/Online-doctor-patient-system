@extends('layouts.app')

@section('content')
<div class="banner" id="home">
	<div class="layer">
		<div class="container banner-text-agile">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-center bg-white">
                            <h4 class="card-title" style="padding-top: 50px;">{{ __('Update profile') }}</h4>
                        </div>

                        <div class="card-body">
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    <p>{{ session('error') }}</p>
                                </div>
                            @endif
                            <form method="POST" action="{{ url('update.role.post/'.Auth::user()->id) }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="select">{{ __('Select one') }}</label>

                                    <div class="col-md-12">
                                    <select name="role" class="form-control @error('role') is-invalid @enderror" id="role" required>
                                        <option value="patient">Patient</option>
                                        <option value="doctor">Doctor</option>
                                    </select>

                                        @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            <div class="form-doctor">

                                <div class="form-group">
                                    <label for="specs">{{ __('Specialization') }}</label>

                                    <div class="col-md-12">
                                        <input id="spec" type="text" class="form-control @error('spec') is-invalid @enderror" name="spec" value="{{ old('spec') }}" autocomplete="email">

                                        @error('spec')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="desc">{{ __('Description') }}</label>

                                    <div class="col-md-12">
                                        <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" autocomplete="description"></textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="hospital">{{ __('Hospital') }}</label>

                                    <div class="col-md-12">
                                        <input id="hospital" type="text" class="form-control @error('hospital') is-invalid @enderror" name="hospital" value="{{ old('hospital') }}"  autocomplete="hospital">

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="image">{{ __('Image') }}</label>

                                    <div class="col-md-12">
                                        <input id="image" type="file" class="@error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" autocomplete="image">

                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
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
</div>
@endsection
