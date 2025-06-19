@extends('front.layouts.app')
@section('content')
<div class="container sold-container">
    <div class="sold-title">
      <h1>{{getTranslatedWords('cars')}}</h1>
    </div>
    
<div class="row">
    @foreach ($cars as $car)
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card smallcard">

                @php
                    $images = json_decode($car->images);
                @endphp

                <a href="{{ route('car-info', $car->slug) }}" target="_blank">
                    @if(is_array($images) && isset($images[0]))
                        <img src="{{ route('file_show', [$images[0], 'cars']) }}" />
                    @else
                        <img src="{{ asset('images/default-car.jpg') }}" /> {{-- صورة افتراضية --}}
                    @endif
                </a>

                <div class="card-body">
                    <h5 class="card-title">{{ $car->title }}</h5>
                    <div class="small-price">{{ $car->price }} {{ getTranslatedWords('L.E') }}</div>
                    <hr />
                    <div class="card-text">
                        <div class="card-info">
                            <div class="small-year">{{ $car->category->title }}</div>
                            <div class="small-gear">{{ $car->model }}</div>
                            <div class="small-engine">{{ $car->year_model }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

    </div>
    <div class="d-flex justify-content-center">
        {{$cars->links()}}
    </div>
  </div>
@endsection