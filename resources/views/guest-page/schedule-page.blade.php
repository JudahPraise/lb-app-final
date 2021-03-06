@extends('welcome')

@section('main')

<div class="container-fluid d-flex flex-column justify-content-center align-items-center mt-5 mb-5">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">INTERVIEW</h1>
        <p class="lead">Available Schedules</p>
      </div>
    <div class="container d-flex justify-content-center">
      <div class="card-deck mb-3 text-center">
          @foreach ($schedules as $schedule)
          <a href="{{ route('interview.email',['id' => $position->id, 'reg_id' => $registration->id, 'sched_id' => $schedule->id]) }}" class="schedule-card text-dark">
          <div class="card mb-4 shadow-sm">
         
                  <div class="card-header bg-dark text-white">
                    <h4 class="my-0 font-weight-normal">{{ $schedule->getDay() }}</h4>
                  </div>
                  <div class="card-body">
                    <h3 class="card-title pricing-card-title">{{ $schedule->getDate() }}</h3>
                    <p>{{ $schedule->getTimeFrom() }} - {{ $schedule->getTimeTo() }}</p>
                    <small style="font-size: 15px"><strong>via</strong> Google Meet</small>
                  </div>
                  
              </div>
              </a>
              
          @endforeach
      </div>
    </div>
</div>

@endsection