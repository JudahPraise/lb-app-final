@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if ($registrations->isEmpty())
                    <div class="container-fluid d-flex flex-column align-items-center" data-toggle="modal" data-target="#exampleModal">
                        <img src="{{ asset('svg/undraw_empty_street.svg') }}" alt="" srcset="" height="250" width="250">
                        <span>Nothing in here</span>
                    </div>
                  @else
                    <table class="table table-striped table-bordered dt-responsive nowrap " id="myTable" style="width:100%">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Contact number</th>
                          <th>Email address</th>
                          <th>Position</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($registrations as $registration)
                          <tr>
                              <td>{{ $registration->getFullname() }}</td>
                              <td>{{ $registration->contact_no }}</td>
                              <td>{{ $registration->email_address }}</td>
                              <td>{{ $registration->getPosition() }}</td>
                              <td>
                                  <button class="btn btn-sm btn-primary update-schedule">Edit</button>
                                  <button class="btn btn-sm btn-danger delete-schedule">Delete</button>
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
        });
    </script>
@endsection
