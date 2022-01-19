@extends('position.create')

@section('qualification.create')
<form action="{{ route('setQualifcation.store', $position->id) }}" method="POST">
    @csrf
    @forelse ($qualifications as $qualification)
    <div class="accordion" id="accordionExample">
        <div class="card m-3">
            <div class="card-header d-flex justify-content-between" id="heading{{ $loop->index }}">
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="exampleRadios1" type="button" data-toggle="collapse" data-target="#collapse{{ $loop->index }}" aria-expanded="true" aria-controls="collapse{{ $loop->index }}">
                        {{ $qualification->title }}
                    </label>
                    </div>
                </div>
                <div id="collapse{{ $loop->index }}" class="collapse show" aria-labelledby="heading{{ $loop->index }}" data-parent="#accordionExample">
                    <div class="card-body">
                        <div id="inputContainer">
                        
                        </div>
                        <fieldset>
                            @foreach($qualification->options as $option)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="{{ $option['option'] }}  "id="exampleRadios1"  value="{{ $option['option'] }}"
                                        data-qualified="{{ $option['option'] }}"
                                        data-point="{{ $option['point'] }}"
                                        data-id="{{ $qualification->id }}"
                                        data-positionid="{{ $position->id }}"
                                    >
                                    <label class="form-check-label" for="{{ $option['option'] }}">
                                        {{ $option['option'] }}
                                    </label>
                                </div> 
                            @endforeach
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <div class="container-fluid d-flex flex-column align-items-center" data-toggle="modal" data-target="#exampleModal">
                <img src="{{ asset('svg/undraw_empty_street.svg') }}" alt="" srcset="" height="250" width="250">
                <span>Nothing in here</span>
            </div>
        @endforelse
    </div>

    <button class="btn btn-primary float-right" type="submit">Save</button>
</form>

<script src="{{ asset('jquery/jquery.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.form-check-input').each(function() {
          $(this).click(function(event){
            var html = ' <input type="number" name="position_id[]" value="'+$(this).data('positionid')+'" hidden><input type="number" name="qualification_id[]" value="'+$(this).data('id')+'" hidden><input type="text" name="qualified_option[]" value="'+$(this).data('qualified')+'" hidden><input type="number" name="point[]" value="'+$(this).data('point')+'" hidden>'
            $('#inputContainer').append(html);
            // $('#qualifiedOption'+$(this).data('id')+'').val($(this).data('qualified'));
            // $('#point'+$(this).data('id')+'').val($(this).data('point'));
            // $('#qualificationId'+$(this).data('id')+'').val($(this).data('id'));
            // $('#positionId'+$(this).data('id')+'').val($(this).data('positionid'));
          })
        })
    })
</script>
@endsection