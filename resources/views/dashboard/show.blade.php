@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center w-100">
    <div class="card shadow border p-5 d-flex justify-content-center align-items-center w-50">
        <h1 style="font-size: 2.5rem; font-weight: bold; font-family: 'Poppins', sans-serif;">{{ $applicant->registration->getFullname() }}</h1>
        <h3>{{ $position->position }}</h3>

        <div class="row d-flex justify-content-center mb-3" style="font-family: 'Poppins', sans-serif;">
            <div class="col-md-4 d-flex flex-column justify-content-center align-items-center m-2">
                <h1 style="font-size: 2.5rem; font-weight: bold; ">{{ $applicant->qualification }}</h1>
                <p class="font-weight-bold text-success" style="text-transform: uppercase">{{ $qualification->status }}</p>
            </div>
            <div class="col-md-4 d-flex flex-column justify-content-center align-items-center m-2">
                <h1 style="font-size: 2.5rem; font-weight: bold; ">{{ $applicant->exam }}</h1>
                <p class="font-weight-bold text-success" style="text-transform: uppercase">{{ $exam->status }}</p>
            </div>
        </div>

        <div class="row d-flex flex-column align-items-center mb-3">
            <p style="font-size: 1.4rem; font-weight: bold;"">Interview</p>
            <h4>{{ $interview->getDate() }} @ {{ $interview->getTime() }}</h4>
            <a href="{{ $interview->link }}">{{ $interview->link }}</a>
        </div>

        <a href="{{ route('dashboard.index') }}" class="btn btn-dark">Back to dashboard</a>
      </div>
</div>
@endsection