@extends('layouts.app')

@section('content')
<div class="banner" id="home">
	<div class="layer">
		<div class="container">
			<div class="banner-text-agile">
				<div class="row">
					<div class="col-lg-6 p-0">
						<!-- banner slider-->
					<div class="csslider infinity" id="slider1">
						<input type="radio" name="slides" checked="checked" id="slides_1" />
						<input type="radio" name="slides" id="slides_2" />
						<input type="radio" name="slides" id="slides_3" />
						<ul class="banner_slide_bg">
							<li>
								<div class="container-fluid">
									<div class="w3ls_banner_txt">
										<h3 class="b-w3ltxt text-capitalize mt-md-4"><span>Qualified Doctors</span></h3>
										<p class="w3ls_pvt-title my-3">
                                            Proctor provides a platform for patients to access qualified doctors in various disciplines with higher competency. They are dedicated have experience in their specialized areas and are here to deliver quality services to all clients who would like to use this plartform;
                                        </p>
									</div>
								</div>
							</li>
						</ul>
					</div>

					</div>
					<div class="col-lg-6 col-md-8">
						<img src="images/b.jpg" alt="" class="img-fluid" />
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Doctors -->
<section class="about py-5">
	<div class="container">
		<h2 class="heading text-center mb-sm-5 mb-4">Doctors</h2>
		<form class="form- col-md-12 " action="{{route('search')}}" method="POST">
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-8">
				@csrf
					<input class="form-control form-control-rounded @error('specialty') is-invalid @enderror" name="specialty" id="specialty" required placeholder="Search Doctors by specialties">
				</div>
				<div class="col-md-2">
					<button class="btn btn-primary btn-rounded" type="submit" name="search"><i class="fa fa-search">Search</i></button>
				</div>
				<div class="col-md-1"></div>
			</div>
		</form>
		<br>
		<br>
		<div class="row">
                @if (!empty($doctors))
                @foreach ($doctors as $item)
                <div class="col-lg-6">
				<div class="card">
                    <div class="card-body">
                        <h4 class="text text-center"><a href="{{url('doctor-profile/'.$item->id)}}"><b>Dr. {{$item->name}}</b></a></h4>
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{asset('images/'.$item->specialty->image)}}" alt="" width="220px" height="220px" style="border-radius: 50%;">
                            </div>
                            <div class="col-md-8">
                                <p><b>{{$item->specialty->name}}</b></p>
                                <p class="card-text">{{$item->specialty->description}}</p>
                                <h6>{{$item->specialty->hospital}}</h6>

                                <p><b>Tel: </b>{{$item->phone}}</p>
                                <div class="card-link">
                                    @if (auth()->user() && auth()->user()->role !== null && auth()->user()->role->name === "doctor")
                                    @else
                                    <a href="{{URL::signedRoute('book',$item->id)}}" class="btn btn-primary btn-sm">Book Appointment</a>
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
</section>
<!-- //about -->

{{-- <section class="services py-5">
	<div class="container py-lg-5">
		<h3 class="heading text-center mb-sm-5 mb-4">What we do </h3>
		<div class="row offer-grids">
			<div class="col-lg-4 col-md-6">
				<div class="ser1">
					<div class="bg-layer">
						<h4 class="">Service1</h4>
						<p class="mt-3">Vestibulum ante ipsum primiss sed inorc faucibus orcit luctus ipsum et ultrices sede edt posuere cubiliater Curae nisl, Curabit ur quis luctu.</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 mt-md-0 mt-4">
				<div class="ser2">
					<div class="bg-layer">
						<h4 class="">Service2</h4>
						<p class="mt-3">Vestibulum ante ipsum primiss sed inorc faucibus orcit luctus ipsum et ultrices sede edt posuere cubiliater Curae nisl, Curabit ur quis luctu.</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 mt-lg-0 mt-4">
				<div class="ser3">
					<div class="bg-layer">
						<h4 class="">Service3</h4>
						<p class="mt-3">Vestibulum ante ipsum primiss sed inorc faucibus orcit luctus ipsum et ultrices sede edt posuere cubiliater Curae nisl, Curabit ur quis luctu.</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 mt-4">
				<div class="ser4">
					<div class="bg-layer">
						<h4 class="">Service4</h4>
						<p class="mt-3">Vestibulum ante ipsum primiss sed inorc faucibus orcit luctus ipsum et ultrices sede edt posuere cubiliater Curae nisl, Curabit ur quis luctu.</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 mt-4">
				<div class="ser5">
					<div class="bg-layer">
						<h4 class="">Service5</h4>
						<p class="mt-3">Vestibulum ante ipsum primiss sed inorc faucibus orcit luctus ipsum et ultrices sede edt posuere cubiliater Curae nisl, Curabit ur quis luctu.</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 mt-4">
				<div class="ser6">
					<div class="bg-layer">
						<h4 class="">Service6</h4>
						<p class="mt-3">Vestibulum ante ipsum primiss sed inorc faucibus orcit luctus ipsum et ultrices sede edt posuere cubiliater Curae nisl, Curabit ur quis luctu.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section> --}}



{{-- <section class="appointment text-center py-5">
	<div class="container py-sm-3">
		<h4>In need of medical services</h4>
		<p class="mt-3">Book Your Appointment with our Doctors Today</p>
		<a href="{{ route('doctor.index') }}">Book an Appointment</a>
	</div>
</section> --}}
@endSection
