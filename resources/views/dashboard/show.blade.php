@extends('layouts.app')

@section('css')
    <style>
        .overlay{
            position: absolute;
            background-color: transparent;
            height: 85vh;
            width: 94%;
            top: 3rem;
            left: 0;
            z-index: 11;
        }

        .overlay::after{
            content: "";
            background-color: transparent;
            width: 40px;
            height: 30px;
            position: absolute;
            right: -22px;
            top: 2rem;
        }

        embed{
            z-index: 10;
        }

    </style>
@endsection

@section('content')
@component('components.alerts')@endcomponent
<div class="container d-flex justify-content-center align-items-center w-100">
    <div class="row w-100">
        <div class="col-lg-5 mb-3">
            <div class="card shadow border p-5 d-flex justify-content-center align-items-center w-100">
                <h2 style="font-size: 2.5rem; font-weight: bold; font-family: 'Poppins', sans-serif;">{{ $applicant->registration->getFullname() }}</h2>
                <h3>{{ $position->position }}</h3>
        
                <div class="row d-flex justify-content-center mb-3" style="font-family: 'Poppins', sans-serif;">
                    <div class="col-md-4 d-flex flex-column justify-content-center align-items-center m-2">
                        <h1 style="font-size: 2.5rem; font-weight: bold; ">{{ $applicant->qualification }}</h1>
                        <p class="font-weight-bold text-success" style="text-transform: uppercase">{{ $qualification->status }}</p>
                    </div>
                    <div class="col-md-4 d-flex flex-column justify-content-center align-items-center m-2">
                        <h1 style="font-size: 2.5rem; font-weight: bold; ">{{ $applicant->exam }}</h1>
                        <p class="font-weight-bold text-success" style="text-transform: uppercase">{{ $exam->status }}</p>
                    </div>
                </div>
        
                <div class="row d-flex flex-column align-items-center mb-3">
                    <p style="font-size: 1.4rem; font-weight: bold;"">Interview</p>
                    @if ($applicant->schedule_id == null)
                        <p style="font-size: 1.4rem">{{ $applicant->registration->interview_status }}</p>
                        <button class="btn btn-primary"  data-toggle="modal" data-target="#sendSchedule">Send Schedule</button>
                    @else
                        <h4 class="text-center">{{ $interview->getDate() }} <br> {{ $interview->getTime() }}</h4>
                        <a href="{{ $interview->link }}">{{ $interview->link }}</a>
                    @endif
                </div>
        
                <a href="{{ route('dashboard.index') }}" class="btn btn-dark">Back to dashboard</a>
            </div>
        </div>
        <div class="col-lg-7 d-flex flex-column align-items-center" style="height: 90vh" >
            <div class="row d-flex justify-content-between w-100 mb-3">
                <h2 class="font-weight-bold">Resume</h2>
                @if($applicant->registration->resume_permission == 1)
                    <a href="{{ route('resume.download', $applicant->registration->id) }}" class="btn btn-success">Download</a>
                @endif
            </div>
            @if($applicant->registration->resume_permission == 0)
                <span>You don't have permission to download or print the applicant resume.</span>
                <br>
                <span>To scroll the document kindly use the scroll bar</span>
                <div class="overlay" oncontextmenu="return false"></div>
                <embed id="resume" src="{{ asset('storage/documents/'.$applicant->registration->resume."#toolbar=0&view=fitH,100") }}" type="application/pdf" width="100%" height="100%"/>
            @else
                <embed id="resume" src="{{ asset('storage/documents/'.$applicant->registration->resume."#view=fitH,100") }}" type="application/pdf" width="100%" height="100%"/>
            @endif
        </div>

        <!-- Modal -->
        <div class="modal fade" id="sendSchedule" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Send Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body p-3">
                <form action="{{ route('send.Schedule', $applicant->registration->id) }}" method="POST" id="sendNewSched">
                    @csrf
                    <div class="form-row mb-3">
                       <div class="form-group col-lg-6">
                            <label for="exampleInputEmail1">Name</label>
                            <input class="form-control" name="name" value="{{ $applicant->registration->getFullname() }}">
                       </div>
                       <div class="form-group col-lg-6">
                            <label for="exampleInputEmail1">Email Address</label>
                            <input class="form-control" name="email" value="{{ $applicant->registration->email_address }}">
                       </div>
                    </div>
                    <hr>
                    <div class="form-group mb-3">
                      <label for="exampleInputEmail1">Date</label>
                      <input type="date" class="form-control" name="date" id="date">
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="exampleInputEmail1">From</label>
                            <input type="time" class="form-control" name="time_from"  id="timeFrom" placeholder="First name">
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1">To</label>
                          <input type="time" class="form-control" name="time_to" id="timeTo" placeholder="Last name">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">Meeting Link</label>
                        <input type="text" class="form-control" name="link" id="meetingLink" aria-describedby="emailHelp">
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('sendNewSched').submit()">Send</button>
              </div>
            </div>
          </div>
        </div>
  
    </div>
</div>
@endsection

@section('scripts')  
    <script>
        $('embed').on("contextmenu", function(e){
            alert('right click disabled');
            return false;
        });
    </script>
@endsection
