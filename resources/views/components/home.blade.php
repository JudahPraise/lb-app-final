<div class="container-fluid d-flex justify-content-center">
    <div class="row m-md-5 w-75">
        <div class="col-md-6 d-flex flex-column justify-content-center">
            <div class="container">
                <p>Lorem ipsum dolor sit.</p>
            </div>
            <div class="container">
                <h1>The simple way to connect and apply on our company.</h1>
            </div>
            <div class="container">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus, quos. Quam atque corporis debitis nihil.</p>
            </div>
            <div class="container">
                @if ($positions->isEmpty())
                    <p><i class="fas fa-exclamation-circle text-danger mr-2"></i>No job openings at this time</p>
                @else
                    <a class="btn btn-dark" href="{{ route('register.index') }}">Apply now <i class="far fa-arrow-alt-circle-right ml-1"></i></a>
                @endif
            </div>
        </div>
        <div class="col-md-6 d-none d-sm-block">
            <img src="{{ asset('images/we-are-hiring.png') }}" alt="" srcset="" style="width: 90%; height: 90%">
        </div>
    </div>
</div>