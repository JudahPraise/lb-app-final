@extends('welcome')

@section('main')
    <!-- @component('components.alerts')@endcomponent -->
    <div class="container-fluid d-flex flex-column justify-content-center align-items-center">
        <div class="container d-flex justify-content-center mb-3">
            <h3>JOBS AVAILABLE</h3>
        </div>
        <div class="row row-cols-1 row-cols-md-2 w-75">
            @forelse ($positions as $position)
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
            @empty

            @endforelse
        </div>
    </div>
    <script src="{{ secure_asset('jquery/jquery.js') }}"></script>
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