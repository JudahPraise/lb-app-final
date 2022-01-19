@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if ($passers->isEmpty())
                    <div class="container-fluid d-flex flex-column align-items-center" data-toggle="modal" data-target="#exampleModal">
                        <img src="{{ secure_asset('svg/undraw_empty_street.svg') }}" alt="" srcset="" height="250" width="250">
                        <span>Nothing in here</span>
                    </div>
                  @else
                    <table class="table table-striped table-bordered dt-responsive nowrap " id="myTable" style="width:100%">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Interview</th>
                          <th>Email address</th>
                          <th>Position</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($passers as $data)
                          <tr>
                              <td>{{ $data->registration->getFullname() }}</td>
                              <td>{{ $data->schedule->getDate() }} - {{ $data->schedule->getTime() }}</td>
                              <td>{{ $data->registration->email_address }}</td>
                              <td>{{ $data->registration->getPosition() }}</td>
                              <td>
                                  <a href="{{ route('dashboard.show', $data->registration->id) }}" class="btn btn-sm btn-primary update-schedule">Show</a>
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
