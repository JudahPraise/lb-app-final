@extends('welcome')

@section('main')
<div class="container">
    <div class="row">
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
    <div class="row">
        <form class="w-100" action="{{ route('applicant.qualification.result', ['id' => $position->id, 'reg_id' => $registration->id]) }}" method="GET">
            @csrf
            <div class="card w-100">
                <div class="card-body">
                    <h2 class="card-title">Qualifications</h2>
                    @foreach($qualified as $data)
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 style="font-size: 1rem; font-weight: bold">{{ $data->qualification->title }}</h4>
                            </div>
                            <div id="inputContainer">
                                {{-- <input type="number" name="registration_id[]" value="" id="{{ 'regid'.$data->qualification->id }}" >
                                <input type="number" name="points[]" value="" id="{{ 'points'.$data->qualification->id }}" > --}}
                            </div>
                            <div class="card-body">
                                <div class="row row-cols-1 row-cols-md-3 d-flex flex-column">
                                    @foreach ($data->qualification->options as $option)
                                        <div class="col shadow p-3 m-2 rounded hvr-fade hvr-float option"
                                        data-registrationid="{{ $registration->id }}"
                                        data-point="{{ $option['point'] }}"
                                        data-option="{{ $loop->index }}"
                                        >
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="points[]" id="{{ $option['option'] }}" 
                                                value="{{ $data->qualified_option === $option['option'] ? $data->point : '0' }}"
                                                hidden>
                                                <label class="form-check-label" for="points" style="font-size: 1rem; font-weight: bold">
                                                    {{ $option['option'] }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<script src="{{ asset('jquery/jquery.js') }}"></script>
<script>
    $(document).ready(function(){

        $('.option').each(function() {
          $(this).click(function(event){
                var html = ' <input type="number" name="registration_id[]" value="'+$(this).data('registrationid')+'" id="reg'+$(this).data('option')+'" hidden><input type="number" name="points[]" value="'+$(this).data('point')+'" id="point'+$(this).data('option')+'" hidden>'
                if($(this).hasClass('selected_option') )
                {
                    $(this).removeClass('selected_option');
                    $('#reg'+$(this).data('option')+'').remove()
                    $('#point'+$(this).data('option')+'').remove()
                }
                else
                {
                    $(this).addClass('selected_option');
                    $('#inputContainer').append(html);
                
                }
          })
        })
    })
</script>
@endsection