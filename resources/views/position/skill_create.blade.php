@extends('position.create')

@section('qualification.create')
<div class="accordion" id="accordionExample">
  <form action="{{ route('setSkills.store', $position->id) }}" method="POST">
    @csrf
    @forelse ($skills as $skill)
      <div class="card mb-3">
        <div class="card-header" id="headingOne">
            <div class="form-check d-flex align-items-center">
              <input class="form-check-input" {{ $skill->questions->isEmpty() ? 'disabled' : '' }} type="checkbox" name="skill_id[]" value="{{ $skill->id }}" id="defaultCheck1">
              <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{ $loop->index }}" aria-expanded="true" aria-controls="collapse{{ $loop->index }}">
                {{ $skill->skill_title }}
              </button>
            </div>
        </div>
      
        <div id="collapse{{ $loop->index }}" class="collapse" aria-labelledby="heading{{ $loop->index }} data-parent="#accordionExample">
          <div class="card-body">
            <span>
                <strong>Skill</strong>
                <h5>{{ $skill->skill_title }}</h5>
            </span>
            <span>
                <strong>Description</strong>
                <p>{{ $skill->description }}</p>
            </span>
            <hr>
            @forelse ($skill->questions as $question)
                <span>
                    <strong>Question #{{ $loop->index+1 }}</strong>
                    <p style="font-size: 1.2rem">{{ $question->question }}</p>
                  </span>
                  <span>
                    <ul>
                      @foreach ($question->choices as $choice)
                        <li class="{{ $choice->points == 10 ? 'font-weight-bold' : '' }}">{{ $choice->choice }}
                        @if ($choice->points == 10)
                          <i class="fas fa-check-circle text-success"></i>
                        @else
                          <i class="fas fa-times-circle text-danger"></i>
                        @endif
                      </li>
                      @endforeach
                    </ul>
                </span>
                @empty
                  <div class="container-fluid d-flex flex-column align-items-center" data-toggle="modal" data-target="#exampleModal">
                    <img src="{{ asset('svg/undraw_empty_street.svg') }}" alt="" srcset="" height="250" width="250">
                    <span>Nothing in here</span>
                  </div>
                @endforelse
              <button class="btn btn-secondary float-right m-2" type="button" data-toggle="collapse" data-target="#collapse{{ $loop->index }}">Collapse</button>
          </div>
        </div>
      </div>
    @empty
        <div class="container-fluid d-flex flex-column align-items-center" data-toggle="modal" data-target="#exampleModal">
          <img src="{{ asset('svg/undraw_empty_street.svg') }}" alt="" srcset="" height="250" width="250">
          <span>Nothing in here</span>
        </div>
    @endforelse
    <button type="submit" class="btn btn-primary float-right">Save</button>
  </form> 
</div>
@endsection