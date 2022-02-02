@extends('position.show')

@section('qualifications')
@forelse ($getSkills as $skill)
  <div class="accordion" id="accordionExample">
      <div class="card mb-3">
        <div class="card-header d-flex justify-content-between align-items-center" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{ $loop->index }}" aria-expanded="true" aria-controls="collapse{{ $loop->index }}">
              {{ $skill->skills->skill_title }}
            </button>
          </h2>
          <a style="cursor: pointer" 
          id="deleteSkill" 
          class="delete-setskill" 
          data-skillid="{{ $skill->id }}"
          data-toggle="modal" data-target="#skillDeleteModal"
          >
            <i class="fas fa-trash text-danger"></i>
          </a>
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
                    <img src="{{ asset('svg/undraw_empty_street.svg') }}" alt="" srcset="" height="250" width="250">
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
              <img src="{{ asset('svg/undraw_add.svg') }}" alt="" srcset="" height="250" width="250">
              <span>Add Skills</span>
          </div>
      </a>
  @endforelse
  
  @if($getSkills->isNotEmpty())
    <div class="row d-flex justify-content-end">
      <a href="{{ route('setSkills.index', $position->id) }}" class="btn btn-success mr-2">Add Skill</a>
    </div>
  @endif

  <!-- Delete Modal -->
  <div class="modal fade" id="skillDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Skill</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" id="setskillDeleteForm">
            @method('DELETE')
            @csrf
              <div class="container">
                <p>Are you sure you want to delete this skill?</p>
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" onclick="document.getElementById('setskillDeleteForm').submit()">Delete</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function(){
      $('.delete-setskill').each(function() {
        $(this).click(function(event){
          console.log($(this).data('skillid'));
          $('#setskillDeleteForm').attr("action", "/position/skill/delete/"+$(this).data('skillid')+"");
        })
      })
    })
  </script>
@endsection