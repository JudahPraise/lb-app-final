@extends('position.show')

@section('qualifications')
@forelse ($getSkills as $skill)
  <div class="accordion" id="accordionExample">
      <div class="card mb-3">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{ $loop->index }}" aria-expanded="true" aria-controls="collapse{{ $loop->index }}">
              {{ $skill->skills->skill_title }}
            </button>
          </h2>
        </div>
      
        <div id="collapse{{ $loop->index }}" class="collapse" aria-labelledby="heading{{ $loop->index }}" data-parent="#accordionExample">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <span>
                  <strong>Skill</strong>
                  <h5>{{ $skill->skills->skill_title }}</h5>
                </span>
                <span>
                    <strong>Description</strong>
                    <p>{{ $skill->skills->description }}</p>
                </span>
              </div>
              <div class="col-md-6">
                <span>
                  <strong>Total Points: {{ $skill->points }}</strong>
              </span>
              </div>
            </div>
            <hr>
            @forelse ($skill->skills->questions as $question)
              <span>
                  <strong>Question #{{ $loop->index+1 }}</strong>
                  <p style="font-size: 1.2rem">{{ $question->question }}</p>
                </span>
                <span>
                  <ul>
                    @foreach ($question->choices as $choice)
                      <li class="{{ $choice->points == 10 ? 'font-weight-bold' : '' }}">
                        {{ $choice->choice }}
                        @if ($choice->points == 10)
                          <i class="fas fa-check-circle text-success"></i>
                        @else
                          <i class="fas fa-times-circle text-danger"></i>
                        @endif
                      </li>
                    @endforeach
                  </ul>
                </span>
              </span>
            @empty
                <div class="container-fluid d-flex flex-column align-items-center" data-toggle="modal" data-target="#exampleModal">
                    <img src="{{ secure_asset('svg/undraw_empty_street.svg') }}" alt="" srcset="" height="250" width="250">
                    <span>Nothing in here</span>
                </div>
            @endforelse
          </div>
          <button class="btn btn-secondary float-right m-2" type="button" data-toggle="collapse" data-target="#collapse{{ $loop->index }}">Collapse</button>
        </div>
      </div>
  </div>
  @empty
      <a href="{{ route('setSkills.index', $position->id) }}">
          <div class="container-fluid d-flex flex-column align-items-center" data-toggle="modal" data-target="#exampleModal">
              <img src="{{ secure_asset('svg/undraw_add.svg') }}" alt="" srcset="" height="250" width="250">
              <span>Add Skills</span>
          </div>
      </a>
  @endforelse
@endsection