@extends('welcome')

@section('main')
<div class="container-fluid d-flex flex-column justify-content-center align-items-center mt-5 mb-5">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">JOB OPENINGS</h1>
        <p class="lead">Try to apply on other position</p>
    </div>
    <div class="row row-cols-1 row-cols-md-2 w-75">
        @forelse ($otherPositions as $position)
            <a class="position-card text-dark" href="{{ route('other.position.apply',  ['id'=>$position->id, 'reg_id'=>$registration->id]) }}">
                <div class="col">
                    <div class="card card2 m-2">
                      <div class="card-body">
                        <p>{{ $position->department." "."Department" }}</p>
                        <h4 class="card-title">{{ $position->position }}</h4>
                        <p class="card-text">{{ $position->description }}</p>
                      </div>
                    </div>
                </div> 
            </a>           
        @empty

        @endforelse
    </div>
</div>

<script src="{{ asset('jquery/jquery.js') }}"></script>

@endsection