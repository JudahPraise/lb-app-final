@if ($positions->isEmpty())
    <div class="container-fluid d-flex justify-content-center ">
        <div class="row m-md-5 w-75">
            <div class="col-md-6 d-none d-sm-block">
                <img src="{{ asset('images/no-messages.png') }}" alt="" srcset="" style="width: 90%; height: 90%">
            </div>
            <div class="col-md-6 d-flex flex-column justify-content-center">
                <div class="container">
                    <h1>No job openings at this time</h1>
                </div>
                <div class="container">
                    <p>Wait for our further announcement</p>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="container-fluid d-flex flex-column align-items-center">
        <div class="container d-flex justify-content-center mb-3">
            <h3>JOBS AVAILABLE</h3>
        </div>
        <div class="row row-cols-1 row-cols-md-2 d-flex mb-4">        
            @foreach ($positions as $position)
                <div class="col mb-4 d-flex justify-content-center">
                    <div class="card card2" style="width: 30rem">
                      <div class="card-body">
                        <p>{{ $position->department." "."Department" }}</p>
                        <h2 class="card-title">{{ $position->position }}</h2>
                        <p class="card-text">{{ $position->description }}</p>
                      </div>
                    </div>
                </div>        
            @endforeach
        </div>
    </div> 
@endif