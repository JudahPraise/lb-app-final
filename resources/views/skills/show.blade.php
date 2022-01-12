@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Skills</h3>
    @component('components.alerts')@endcomponent
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>{{ __('Test Questions') }}</span>
                    @component('components.buttons')
                      @slot('route')
                        {{ route('skill.index') }}
                      @endslot
                      @slot('modal')
                        {{ "addModal" }}
                      @endslot
                    @endcomponent
                </div>
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
                    @forelse ($questions as $question)
                    <span class="d-flex justify-content-between">
                      <span>
                        <strong>Question #{{ $loop->index+1 }}</strong>
                        <p style="font-size: 1.2rem">{{ $question->question }}</p>
                      </span>
                      <span>
                        <div class="btn dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </div>
                        <div class="dropdown-menu">
                          <a class="dropdown-item edit-skill" href="{{ route('seQuestion.edit', $question->id) }}" id="skillEdit">Edit</a>
                          <a class="dropdown-item delete-question"
                          id="skillDelete"
                          data-toggle="modal" data-target="#deleteModal"
                          data-questionid="{{ $question->id }}"
                          >Delete</a>
                        </div>
                      </span>
                    </span>
                    <span>
                      <ul>
                        @foreach ($question->choices as $choice)
                            <li class="{{ $choice->points == 10 ? 'font-weight-bold' : ''}}">
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
                    @empty
                      <div class="container">
                        <div class="row py-2">
                          <div class="container-fluid d-flex flex-column align-items-center" data-toggle="modal" data-target="#addModal">
                            <img src="{{ asset('svg/undraw_add.svg') }}" alt="" srcset="" height="250" width="250">
                            <span>Add Questions</span>
                          </div>
                        </div>
                      </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
  
    <!-- Modal Add -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Question</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('seQuestion.store') }}" method="POST" id="skillAdd"> 
              @csrf
              <input type="text" class="form-control" name="skill_id" value="{{ $skill->id }}" id="exampleInputEmail1" hidden>
              <div class="form-group">
                <label for="exampleInputEmail1">Question</label>
                <input type="text" class="form-control" name="question" id="exampleInputEmail1">
              </div>
              <div class="form-group inputs_div">
                <div class="form-row mb-3 d-flex align-items-end">
                  <div class="col-6">
                      <label for="exampleInputEmail1">Choices</label>
                      <input type="text" class="form-control" name="choice[]" id="exampleInputEmail1">
                  </div>
                  <div class="col-3">
                      <label for="exampleFormControlSelect1">Correct Choice</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="points[]">
                        <option value="10">Right</option>
                        <option value="0" selected>Wrong</option>
                      </select>
                  </div>
                  <button type="button" class="btn btn-success add">Add option</button>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="document.getElementById('skillAdd').submit()">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Skill</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" id="deleteForm">
              @method('DELETE')
              @csrf
                <div class="container">
                  <p>Are you sure you want to delete this item?</p>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" onclick="document.getElementById('deleteForm').submit()">Delete</button>
          </div>
        </div>
      </div>
    </div>
</div>
<script>
  $(document).ready(function(){
    $(this).on("click", ".add", function(){
      var html = '<div class="form-row mb-3 d-flex align-items-end"><div class="col-6"><input type="text" class="form-control" name="choice[]" id="exampleInputEmail1"></div><div class="col-3"><select class="form-control" id="exampleFormControlSelect1" name="points[]"><option value="10">Right</option><option value="0" selected>Wrong</option></select></div><button type="button" class="btn btn-danger remove">Remove</button></div>'
      console.log('get');
      $('.inputs_div').append(html);
    // console.log('hello');
    });
    $(this).on("click", ".remove", function(){
      var target_input = $(this).parent();
        target_input.remove();
    });
    $('.delete-question').each(function() {
      $(this).click(function(event){
        $('#deleteForm').attr("action", "/skills/delete/question/"+$(this).data('questionid')+"")
      })
    })
  });
</script>

@endsection
