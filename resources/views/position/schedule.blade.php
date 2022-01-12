@extends('position.show')

@section('qualifications')
<div class="card-columns">
    @foreach ($schedules as $schedule)
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
              <h5 class="my-0 font-weight-normal text-center">Available Schedule</h5>
            </div>
            <div class="card-body d-flex flex-column align-items-center">
                <h2 class="card-title pricing-card-title">{{ $schedule->getDay() }}</h2>
                <small>{{ $schedule->getDate() }}</small>
                <small>{{ $schedule->getTimeFrom() }} - {{ $schedule->getTimeTo() }}</small>
                <span class="iconify mt-3" data-icon="logos:google-meet" data-width="50" data-height="50"></span>
                <small><strong>via</strong> Google Meet</small>

                <div class="container p-3 d-flex flex-column align-items-center">
                    <strong>Meeting Link</strong>
                    <a href="https://{{ $schedule->link }}">{{ $schedule->link }}</a>
                </div>
               <div class="row">
                    <button type="button" class="btn btn-primary m-1">Edit</button>
                    <button type="button" class="btn btn-danger m-1 delete-schedule"
                    data-toggle="modal" data-target="#deleteModal"
                    data-schedid="{{ $schedule->id }}"
                    >Delete</button>
               </div>
            </div>
        </div>
    @endforeach
</div>
@if ($schedules->isEmpty())
    <div class="container-fluid d-flex flex-column align-items-center" data-toggle="modal" data-target="#exampleModal">
        <img src="{{ asset('svg/undraw_empty_street.svg') }}" alt="" srcset="" height="250" width="250">
        <span>Nothing in here</span>
    </div>
@endif
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
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.delete-schedule').each(function() {
                $(this).click(function(event){
                  $('#deleteForm').attr("action", "/interview/delete/"+$(this).data('schedid')+"")
                })
            });
        })
    </script>
@endsection