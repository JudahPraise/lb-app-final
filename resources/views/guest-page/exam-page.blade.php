@extends('welcome')

@section('main')
<div class="container">
  @component('components.alerts')@endcomponent
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <span>
            <h2 class="card-title">{{ $position->position }}</h2>
            <small>{{ $position->department.' '.'Department' }}</small>
          </span>
          <p class="card-text">{{ $position->description }}</p>
          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 mb-3">
      <h3>Skills</h3>
      <div class="list-group" id="list-tab" role="tablist">
        @foreach ($skills as $skill)
          <a class="list-group-item list-group-item-action {{ $answers->contains('skill_id', $skill->id) ? 'bg-success' : '' }} {{ $loop->index === 0 ? 'active' : '' }}" id="list-{{ $skill->id }}-list" data-toggle="list" href="#list-{{ $skill->id }}" role="tab" aria-controls="{{ $skill->id }}">{{ $skill->skills->skill_title }}</a>
        @endforeach
      </div>
      <div class="row">
        <p class="text-muted font-italic"><span class="text-danger">*</span>Important</p>
        <p class="text-muted font-italic">Kindly answer all the questions per skill sets.</p>
      </div>
    </div>
    <div class="col-md-8">
      <h3>Test Form</h3>
      <div class="tab-content" id="nav-tabContent">
        @foreach ($skills as $skill)
          <div class="tab-pane fade show {{ $loop->index === 0 ? 'active' : '' }}" id="list-{{ $skill->id }}" role="tabpanel"   aria-labelledby="list-{{ $skill->id }}-list">
            <div class="card w-100">
              <div class="card-body">
                <form action="{{ route('applicant.skillstest.store', ['id' => $position->id, 'reg_id' => $registration->id]) }}" method="POST">
                    @csrf
                    <div class="row row-cols-1 row-cols-md-2 d-flex flex-column">
                      <div id="inputContainer">  
                        <input type="text" id="id" name="skill_id" value="{{ $skill->skills->id }}" hidden>                
                      </div>
                      @forelse ($skill->skills->questions as $question)
                      <span class="mb-2">
                        <strong>Question #{{ $loop->index+1 }}</strong>
                        <h4 class="mt-2" style="font-size: 1rem; font-weight: bold">{{ $question->question }}</h4>
                      </span>
                      <span>
                        <ul id="question{{ $question->id }}">
                          <input type="number" id="id" name="question_id" value="{{ $question->id }}" hidden>     
                          <input type="number" id="choiceId{{ $question->id }}" name="choice_id[]" value="" hidden>     
                          @foreach ($question->choices as $choice)
                            <div class="form-check">
                              <input class="form-check-input choice" type="radio" name="{{ $question->id }}" id="{{   $choice->choice }}" value="{{ $choice->points }}" data-questionid="{{ $question->id }}"   data-choiceid="{{ $choice->id }}" {{ $answers->contains('choice_id', $choice->id) ? 'checked' : '' }} >
                              <label class="form-check-label" for="{{ $choice->choice }}">
                                {{ $choice->choice }}
                              </label>
                            </div>
                          @endforeach
                        </ul>
                      </span>
                     @endforeach
                    </div>
                      <button class="btn btn-primary float-right" type="submit">Submit</button>
                </form>
              </div>
            </div>
          </div>
          @endforeach
      </div>
    </div>
  </div>
</div>

<script src="{{ secure_asset('jquery/jquery.js') }}"></script>
<script>
    $(document).ready(function(){
      $('.choice').each(function() {
        $(this).click(function(event){
          // points.push($(this).val())
          // var total = 0;
          // for (var i = 0; i < points.length; i++) {
          //     total += points[i] << 0;
          // }
          // $('#totalPoint').val(total);
          // console.log(total);
          $('#point'+$(this).data('questionid')+'').remove();
          var html = '<input type="number" id="point'+$(this).data('questionid')+'" name="point[]" value="'+$(this).val()+'" hidden>'
          $('#question'+$(this).data('questionid')+'').append(html);
          $('#choiceId'+$(this).data('questionid')+'').val($(this).data('choiceid'));
        })
      })

      function setPoint(question, point)
      {
        $('#point'+question+'').val() = "";
      }
    })
</script>
@endsection