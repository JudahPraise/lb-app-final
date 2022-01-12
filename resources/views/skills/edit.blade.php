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
                        {{ route('skill.show', $skill->id) }}
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
                    <form action="{{ route('seQuestion.update', $question->id) }}" method="POST" id="skillAdd"> 
                        @method('PUT')
                        @csrf
                        <input type="text" class="form-control" name="skill_id" value="{{ $skill->id }}" id="exampleInputEmail1" hidden>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Question</label>
                          <input type="text" class="form-control" name="question" value="{{ $question->question }}" id="exampleInputEmail1">
                        </div>
                        <div class="form-group inputs_div">
                          @foreach ($question->choices as $choice)
                            <div class="form-row mb-3 d-flex align-items-end">
                              <div class="col-6">
                                    @if ($loop->index == 0)
                                       <label for="exampleInputEmail1">Choice</label>
                                    @endif
                                  <input type="text" class="form-control" name="choice[]" value="{{ $choice->choice }}" id="exampleInputEmail1">
                              </div>
                              <div class="col-3">
                                    @if ($loop->index == 0)
                                        <label for="exampleFormControlSelect1">Correct Choice</label>
                                    @endif
                                  <select class="form-control" id="exampleFormControlSelect1" name="points[]">
                                    <option {{ $choice->points == 0 ? 'selected' : '' }} value="10">Right</option>
                                    <option {{ $choice->points == 0 ? 'selected' : '' }} value="0">Wrong</option>
                                  </select>
                              </div>
                              <button type="button" class="btn {{ $loop->index == 0 ? 'btn-success add' : 'btn-danger remove' }}">{{ $loop->index == 0 ? 'Add Option' : 'Remove'}}</button>
                            </div>
                          @endforeach
                        </div>

                        <button class="btn btn-primary float-right" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    $(this).on("click", ".add", function(){
      var html = '<div class="form-row mb-3 d-flex align-items-end"><div class="col-6"><label for="exampleInputEmail1">Choices</label><input type="text" class="form-control" name="choice[]" id="exampleInputEmail1"></div><div class="col-3"><label for="exampleFormControlSelect1">Correct Choice</label><select class="form-control" id="exampleFormControlSelect1" name="points[]"><option value="10">Right</option><option value="0">Wrong</option></select></div><button type="button" class="btn btn-danger remove">Remove</button></div>'
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
