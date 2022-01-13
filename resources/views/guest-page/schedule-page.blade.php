@extends('welcome')

@section('main')


    <div class="container-fluid d-flex flex-column justify-content-center align-items-center">
        <div class="container d-flex justify-content-center mb-3">
            <h3>INTERVIEWS AVAILABLE</h3>
        </div>
        <div class="row row-cols-1 row-cols-md-2 w-75">
        @forelse ($schedules as $schedule)
                <a class="interview-card text-dark">
                
                    <div class="col">
                        <div class="card card2 m-2">
                            <div class="card-body">
                                <p>{{ $schedule->date }}</p>
                                <h2 class="card-title">{{ $schedule->link }}</h2>
                                <p class="card-text">{{ $schedule->time_from."-".$schedule->time_to }}</p>  
                            </div>
                        </div>
                    </div> 
                </a>           
            @empty

            @endforelse
        </div>
    </div>

@endsection