@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Position</h3>
    @component('components.alerts')@endcomponent
    <div class="row justify-content-center">
      <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>{{ $position->position }}</span>
                    <a href="{{ route('position.index') }}" class="btn btn-secondary">Back</a>
                </div>
                <div class="card-body">
                    <span>
                        <strong>Department</strong>
                        <h5>{{ $position->department }}</h5>
                    </span>
                    <span>
                        <strong>Description</strong>
                        <p>{{ $position->description }}</p>
                    </span>
                    <hr>
                    <ul class="nav nav-pills nav-fill mb-3">
                        <li class="nav-item">
                          <a class="nav-link {{ Route::currentRouteName() == 'setQualifcation.show' ? 'active' : '' }}" href="{{ route('setQualifcation.show', $position->id) }}">Background</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link {{ Route::currentRouteName() == 'setSkills.show' ? 'active' : '' }}" href="{{ route('setSkills.show', $position->id) }}">Skills</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link {{ Route::currentRouteName() == 'setSchedule.show' ? 'active' : '' }}" href="{{ route('setSchedule.show',  $position->id) }}">Interview Schedule</a>
                        </li>
                    </ul>
                    <main>
                        @yield('qualifications')
                    </main>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
