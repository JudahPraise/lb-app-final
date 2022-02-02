@extends('position.show')

@section('qualifications')
    @forelse ($qualified as $data)
        <span>
            <strong>{{ $data->qualification->title }}</strong>
            <div class="btn dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
              </div>
              <div class="dropdown-menu">
                <a class="dropdown-item delete-setQualification"
                id="skillDelete"
                data-setqualificationid="{{ $data->id }}"
                data-toggle="modal" data-target="#setQualificationDeleteModal"
                >Delete</a>
              </div>
        </span>
        <span class="ml-3 font-italic d-flex justify-content-between">
             <strong class="text-danger">*Qualified: <span class="text-dark">{{ $data->qualified_option }}</span></strong>
            <strong>{{ $data->point }}</strong>
        </span>
        <span>
            <ul>
                @foreach ($data->qualification->options as $option)
                    <li>{{ $option['option'] }}</li>
                @endforeach
            </ul>
        </span>
        @empty
        <a href="{{ route('setQualifcation.index', $position->id) }}">
            <div class="container-fluid d-flex flex-column align-items-center" data-toggle="modal" data-target="#exampleModal">
                <img src="{{ asset('svg/undraw_add.svg') }}" alt="" srcset="" height="250" width="250">
                <span>Add Qualification</span>
            </div>
        </a>
    @endforelse
    <div class="row p-3 d-flex justify-content-between">
        <strong>Qualified points:</strong>
        <strong>{{ $qualified->sum('point') }}</strong>
    </div>

    @if($qualified->isNotEmpty())
        <div class="row d-flex justify-content-end">
            <a href="{{ route('setQualifcation.index', $position->id) }}" class="btn btn-success">Add Qualification</a>
        </div>
    @endif

    <!-- Delete Modal -->
  <div class="modal fade" id="setQualificationDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Skill</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" id="setqualificationDeleteForm">
            @method('DELETE')
            @csrf
              <div class="container">
                <p>Are you sure you want to delete this skill?</p>
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" onclick="document.getElementById('setqualificationDeleteForm').submit()">Delete</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function(){
      $('.delete-setQualification').each(function() {
        $(this).click(function(event){
          console.log($(this).data('skillid'));
          $('#setqualificationDeleteForm').attr("action", "/position/qualification/delete/"+$(this).data('setqualificationid')+"");
        })
      })
    })
  </script>
@endsection