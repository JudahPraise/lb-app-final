@extends('welcome')

@section('main')
<div class="container"></div>
  @component('components.alerts')@endcomponent
  <div class="row w-75">
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
    <div class="skills">
      <form id="skillScoreForm">
        <input type="text" id="skillScore">
      </form>
    </div>
    <div class="row flex-column w-100 pb-0 py-3">
      <form class="w-100" method="POST" id="skillTestSubmit">
        @csrf
        @foreach ($skills as $skill)
          <div class="row d-flex flex-column m-0 p-0 w-100">
            <h3>{{ $skill->skills->skill_title }}</h3>
            <div class="row d-flex flex-column justify-content-start w-100 m-0 p-0">
              @foreach ($skill->skills->questions as $question)
                <div class="row p-0 d-flex flex-column justify-content-start w-100 {{ $loop->index < $loop->count ? 'mb-5' : '' }}">
                  <strong>Question #{{ $loop->index+1 }}</strong>
                  <p>{{ $question->question }}</p>
                  @foreach ($question->choices as $choice)
                    <div class="form-check">
                      <input class="form-check-input choice-input" type="radio" id="{{ $skill->skills->skill_title }}" data-posid="{{ $position->id }}" data-regid="{{ $registration->id }}" data-skill="{{ $question->skill_id }}" name="{{ $question->question }}" value="{{ $choice->points }}" id="defaultCheck1">
                      <label class="form-check-label" for="defaultCheck1">
                        {{ $choice->choice }}
                      </label>
                    </div>
                  @endforeach
                </div>
              @endforeach
            </div>
          </div>
          @if($skills->hasMorePages())
            <div class="row w-100 d-flex justify-content-between m-o p-0">
              <a class="btn btn-primary text-white" href="{{ $skills->previousPageUrl() }}" rel="next">Previous</a>
              <p>Skill {{ $skills->currentPage() }}</p>
              <a class="btn btn-primary text-white"  id="nextBtn" rel="next" >Next</a>
            </div>
          @else
            <div class="row w-100 d-flex justify-content-between m-o p-0">
              <a class="btn btn-primary text-white" href="{{ $skills->previousPageUrl() }}" rel="next">Previous</a>
              <p>Skill {{ $skills->currentPage() }}</p>
              <button class="btn btn-primary" id="submitBtn">Submit</button>
            </div>
          @endif
          <hr>
        @endforeach
      </form>
    </div>
  </div>
</div>
<script src="{{ asset('jquery/jquery.js') }}"></script>
<script>
    $(document).ready(function(){
      let score = 0;
      let skillId = 0;
      let regId = 0;
      let totalScore = 0;
      let posId = 0;

      $('.choice-input').each(function(){
        $(this).click(function(){
          totalScore += parseInt($(this).val());
          score = $(this).val();
          skillId = $(this).data('skill');
          regId = $(this).data('regid');
          posId = $(this).data('posid');
          $('#skillScore').val(totalScore);

          $('#skillTestSubmit').attr('action', "/skill-test/submit/"+$(this).data('posid')+"/"+$(this).data('regid')+"/"+totalScore+"/"+$(this).data('skill')+"");
        })
      });
      $('#nextBtn').click(function(e){
        e.preventDefault()
        var points = totalScore;
        var skill_id = skillId;
        var registration_id = regId;
        var position_id = posId;

        $.ajax({
          url: "/skill-score",
          type: "POST",
          data: {
              _token: "{{csrf_token()}}",
              registration_id: regId,
              position_id: posId,
              skill_id: skillId,
              points: totalScore,
          },
          cache: false,
          success: function(dataResult){
            console.log(dataResult);
            window.location.href="{{ $skills->nextPageUrl() }}"	
          }
        });
      })

      $('#submitBtn').click(function(e){
        e.preventDefault()
        var points = totalScore;
        var skill_id = skillId;
        var registration_id = regId;
        var position_id = posId;

        $.ajax({
          url: "/skill-score",
          type: "POST",
          data: {
              _token: "{{csrf_token()}}",
              registration_id: regId,
              skill_id: skillId,
              position_id: posId,
              points: totalScore,
          },
          cache: false,
          success: function(dataResult){
            $('#skillTestSubmit').submit();
            console.log(dataResult);
          }
        });
      })


    });
</script>
@endsection