@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Interview</h3>
    @component('components.alerts')@endcomponent
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>Available Schedules</span>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add</button>
                </div>
                <div class="card-body">
                  @if ($schedules->isEmpty())
                    <div class="container-fluid d-flex flex-column align-items-center" data-toggle="modal" data-target="#exampleModal">
                        <img src="{{ asset('svg/undraw_empty_street.svg') }}" alt="" srcset="" height="250" width="250">
                        <span>Nothing in here</span>
                    </div>
                  @else
                    <table class="table table-striped table-bordered dt-responsive nowrap " id="myTable" style="width:100%">
                      <thead>
                        <tr>
                          <th>Position</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Meeting Link</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($schedules as $schedule)
                          <tr>
                              <td>{{ $schedule->position->position }}</td>
                              <td>{{ $schedule->getDate() }}</td>
                              <td>{{ $schedule->getTimeFrom().' '.'-'.' '.$schedule->getTimeTo() }}</td>
                              <td><a href="https://{{ $schedule->link }}" target="_blank">{{ $schedule->link }}</a></td>
                              <td>
                                  <button class="btn btn-sm btn-primary update-schedule"
                                  data-toggle="modal" data-target="#updateModal"
                                  data-schedid="{{ $schedule->id }}"
                                  data-position="{{ $schedule->position_id }}"
                                  data-date="{{ $schedule->date }}"
                                  data-timefrom="{{ $schedule->time_from }}"
                                  data-timeto="{{ $schedule->time_to }}"
                                  data-meetinglink="{{ $schedule->link }}"
                                  >Edit</button>
                                  <button class="btn btn-sm btn-danger delete-schedule"
                                  type="button"
                                  data-toggle="modal" data-target="#deleteModal"
                                  data-schedid="{{ $schedule->id }}"
                                  >Delete</button>
                              </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  @endif
                </div>
            </div>  
        </div>
    </div>
</div>

<!--Add Modal -->
<div class="modal fade" id="addModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Schedule Interview</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('interview.store') }}" method="POST" id="schedForm">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Position</label>
                    <select class="form-control"  name="position_id" id="exampleFormControlSelect1">
                            <option selected disabled>Select Position</option>
                        @foreach ($positions as $position)
                            <option value="{{ $position->id }}">{{ $position->position }}</option> 
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                  <label for="exampleInputEmail1">Date</label>
                  <input type="date" class="form-control" name="date" id="exampleInputEmail1">
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="exampleInputEmail1">From</label>
                        <input type="time" class="form-control" name="time_from" placeholder="First name">
                    </div>
                    <div class="col">
                        <label for="exampleInputEmail1">To</label>
                      <input type="time" class="form-control" name="time_to" placeholder="Last name">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="exampleInputEmail1">Meeting Link</label>
                    <input type="text" class="form-control" name="link" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="document.getElementById('schedForm').submit()">Save</button>
        </div>
      </div>
    </div>
</div>

<!-- Update Modal -->
<div class="modal fade" id="updateModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Update Schedule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="POST" id="updateForm">
              @method('PUT')
              @csrf
              <div class="form-group">
                  <label for="exampleFormControlSelect1">Position</label>
                  <select class="form-control"  name="position_id" id="position">
                          <option selected disabled>Select Position</option>
                      @foreach ($positions as $position)
                          <option value="{{ $position->id }}">{{ $position->position }}</option> 
                      @endforeach
                  </select>
              </div>
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
        <button type="button" class="btn btn-primary" onclick="document.getElementById('updateForm').submit()">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Schedule</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" id="deleteForm">
            @method('DELETE')
            @csrf
              <div class="container">
                <p>Are you sure you want to delete this schedule?</p>
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" onclick="document.getElementById('deleteForm').submit()">Delete</button>
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
          $('.delete-schedule').each(function() {
              $(this).click(function(event){
                $('#deleteForm').attr("action", "/interview/delete/"+$(this).data('schedid')+"")
              })
          });
          $('.update-schedule').each(function() {
              $(this).click(function(event){
                $('#updateForm').attr("action", "/interview/update/"+$(this).data('schedid')+"")
                $('#position').val($(this).data('position'));
                $('#date').val($(this).data('date'));
                $('#timeFrom').val($(this).data('timefrom'));
                $('#timeTo').val($(this).data('timeto'));
                $('#meetingLink').val($(this).data('meetinglink'));
              })
          });
        });
    </script>
@endsection