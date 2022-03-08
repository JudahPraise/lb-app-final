@extends('layouts.app')

@section('content')
@component('components.alerts')@endcomponent
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">{{ __('Dashboard') }}</div>
              <div class="card-body">
                  @if ($passers->isEmpty())
                  <div class="container-fluid d-flex flex-column align-items-center mb-3" data-toggle="modal" data-target="#exampleModal">
                      <img src="{{ asset('svg/undraw_empty_street.svg') }}" alt="" srcset="" height="250" width="250">
                      <span>Nothing in here</span>
                  </div>
                @else
                  <table class="table table-striped table-bordered dt-responsive nowrap mb-3" id="myTable" style="width:100%">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Interview</th>
                        <th>Email address</th>
                        <th>Position</th>
                        <th>Set Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($passers as $data)
                        @if ($data->schedule_id == null)
                          <tr>
                            <td>{{ $data->registration->getFullname() }}</td>
                            <td class="{{ $data->registration->interview_status == 'Requesting for Schedule' ? "bg-info font-weight-bold" : " " }}">{{ $data->registration->interview_status }}</td>
                            <td>{{ $data->registration->email_address }}</td>
                            <td>{{ $data->registration->getPosition() }}</td>
                            <td>
                              <button class="btn btn-info send-date"
                                data-regid="{{ $data->registration->id }}"
                                data-name="{{ $data->registration->getFullName() }}"
                                data-email="{{ $data->registration->email_address }}"
                                data-toggle="modal" data-target="#newSendSchedule"
                              >Send Date</button>
                            </td>
                            <td>
                                <a href="{{ route('dashboard.show', $data->registration->id) }}" class="btn btn-sm btn-primary update-schedule">Show</a>
                            </td>
                          </tr>
                        @else
                          <tr>
                            <td>{{ $data->registration->getFullname() }}</td>
                            <td class="{{ $data->schedule->date == Carbon\Carbon::now()->format('Y-m-d') ? "bg-success text-white font-weight-bold" : " " }}">{{ $data->schedule->date == Carbon\Carbon::now()->format('Y-m-d') ? "Today" : $data->schedule->getDate() }} - {{ $data->schedule->getTime() }}</td>
                            <td>{{ $data->registration->email_address }}</td>
                            <td>{{ $data->registration->getPosition() }}</td>
                            <td>
                              @if ($data->schedule->date == Carbon\Carbon::now()->format('Y-m-d'))
                                @if($data->registration->interview_status == 'Passed' || $data->registration->interview_status == 'Failed')
                                  <p class="{{ $data->registration->interview_status == 'Passed' ? 'text-success' : 'text-danger'}}">{{ $data->registration->interview_status }}</p>
                                @else
                                  <div class="dropdown">
                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                      Interview
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <a class="dropdown-item" href="{{ $data->schedule->link }}" target="_blank">Start</a>
                                      <a class="dropdown-item" href="{{ route('interview.status', ['id'=>$data->registration->id, 'status'=>'A777']) }}">Passed</a>
                                      <a class="dropdown-item" href="{{ route('interview.status', ['id'=>$data->registration->id, 'status'=>'B757']) }}">Fail</a>
                                      <a class="dropdown-item send-second" data-regid="{{ $data->registration->id }}"
                                        data-name="{{ $data->registration->getFullName() }}"
                                        data-email="{{ $data->registration->email_address }}"
                                        data-toggle="modal" data-target="#newSendSchedule">Second Interview</a>
                                    </div>
                                  </div>
                                @endif
                              @else
                                {{ $data->registration->interview_status }}
                              @endif
                            </td>
                            <td>
                                <a href="{{ route('dashboard.show', $data->registration->id) }}" class="btn btn-sm btn-primary update-schedule">Show</a>
                            </td>
                          </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                @endif
              </div>
          </div>
      </div>
    </div>
    <!-- New Schedule Modal -->
    <div class="modal fade" id="newSendSchedule" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Send Schedule</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-3">
            <form method="POST" id="newSendScheduleForm">
                @csrf
                <div class="form-row mb-3">
                   <div class="form-group col-lg-6">
                        <label for="exampleInputEmail1">Name</label>
                        <input class="form-control" name="name" id="sendToName">
                   </div>
                   <div class="form-group col-lg-6">
                        <label for="exampleInputEmail1">Email Address</label>
                        <input class="form-control" name="email" id="sendToEmail">
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
            <button type="button" class="btn btn-primary" onclick="document.getElementById('newSendScheduleForm').submit()">Send</button>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('scripts')  
    <script>
        $(document).ready( function () {
          $('#myTable').DataTable({
              responsive:true,
              searching: false,
              bPaginate: false,
              bInfo: false,
          });

          $('.send-date').each(function(){
            $(this).click(function(){
              console.log($(this).data('email'));
              $('#newSendScheduleForm').attr("action", "/send-schedule/"+$(this).data('regid')+"");
              $('#sendToName').val($(this).data('name'));
              $('#sendToEmail').val($(this).data('email'));
            })
          })
          
          $('.send-second').each(function(){
            $(this).click(function(){
              console.log($(this).data('email'));
              $('#newSendScheduleForm').attr("action", "/send-schedule/"+$(this).data('regid')+"");
              $('#sendToName').val($(this).data('name'));
              $('#sendToEmail').val($(this).data('email'));
            })
          })

        });
    </script>
@endsection
