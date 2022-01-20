@extends('welcome')

@section('main')
    <!-- @component('components.alerts')@endcomponent -->
    <div class="container-fluid d-flex flex-column justify-content-center align-items-center mt-5 mb-5">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">JOB OPENINGS</h1>
        </div>
        <div class="row row-cols-1 row-cols-md-2 w-75">
            @forelse ($positions as $position)
                @if ($position->skills->isEmpty() || $position->qualifications->isEmpty() || $position->schedule->isEmpty())
                @else
                    <a class="position-card text-dark" data-registrationid="{{ $registration->id }}" data-positionid="{{ $position->id }}">
                        <form method="POST" id="positionForm">
                            @method('PUT')
                            @csrf
                            <input type="number" name="position_id" id="inputPositionId" hidden>
                        </form>
                        <div class="col">
                            <div class="card card2 m-2">
                              <div class="card-body">
                                <p>{{ $position->department." "."Department" }}</p>
                                <h4 class="card-title">{{ $position->position }}</h4>
                                <p class="card-text">{{ $position->description }}</p>
                              </div>
                            </div>
                        </div> 
                    </a>
                @endif           
            @empty

            @endforelse
        </div>
    </div>
    <script src="{{ asset('jquery/jquery.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.position-card').each(function() {
                $(this).click(function(event){
                  $('#positionForm').attr("action", "/registration/select-position/"+$(this).data('registrationid')+"")
                  $('#inputPositionId').val($(this).data('positionid'));
                  $('#positionForm').submit();
                //   console.log($(this).data('positionid'));
                });
            });
        });
    </script>
@endsection