@extends('welcome')

@section('main')

<div class="container-fluid d-flex flex-column justify-content-center align-items-center mt-5 mb-5">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">INTERVIEW</h1>
        <p class="lead">Interview Schedules</p>
      </div>
    <div class="container">
        <div class="card-deck mb-3 text-center">
            @foreach ($schedules as $schedule)
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-dark text-white">
                      <h4 class="my-0 font-weight-normal">{{ $schedule->getDay() }}</h4>
                    </div>
                    <div class="card-body">
                      <h3 class="card-title pricing-card-title">{{ $schedule->getDate() }}</h3>
                      <p>{{ $schedule->getTimeFrom() }} - {{ $schedule->getTimeTo() }}</p>
                      <small style="font-size: 15px"><strong>via</strong> Google Meet</small>
                      <div class="container p-3 d-flex flex-column align-items-center">
                          <strong>Meeting Link</strong>
                          <a href="https://{{ $schedule->link }}">{{ $schedule->link }}</a>
                      </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection