@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Position</h3>
    @component('components.alerts')@endcomponent
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <span>Available Positions</span>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add</button>
            </div>
            <div class="card-body">
              <div class="container">
                <div class="row py-2">
                  @forelse ($positions as $position)
                  <div class="col-md-4 mb-3">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between">
                          <span class="d-flex flex-column">
                            {{ $position->position }}
                            <strong class="mt-3" style="font-size: .9rem">{{ $position->department }} Department</strong>
                          </span>
                          <span>
                            <div class="btn dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis-v"></i>
                            </div>
                            <div class="dropdown-menu">
                              <a class="dropdown-item edit-position" id="positionEdit"
                              data-positionid="{{ $position->id }}"
                              data-position="{{ $position->position }}"
                              data-department="{{ $position->department }}"
                              data-description="{{ $position->description }}"
                              data-toggle="modal" data-target="#editModal"
                              >Edit</a>
                              <a class="dropdown-item delete-position"
                              id="skillDelete"
                              data-toggle="modal" data-target="#deleteModal"
                              data-positionid="{{ $position->id }}"
                              >Delete</a>
                            </div>
                          </span>
                        </h5>
                        <p class="card-text">{{ $position->description }}</p>
                        <a href="{{ route('setQualifcation.show', $position->id) }}" class="btn btn-primary">Show</a>
                        <a href="{{ route('setQualifcation.index',$position->id) }}" class="btn btn-primary">Set Qualifications</a>
                      </div>
                    </div>
                  </div>
                  @empty
                    <div class="container-fluid d-flex flex-column align-items-center" data-toggle="modal" data-target="#exampleModal">
                      <img src="{{ asset('svg/undraw_add.svg') }}" alt="" srcset="" height="250" width="250">
                      <span>Add Position</span>
                    </div>
                  @endforelse
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Position</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form action="{{ route('position.store') }}" method="POST" id="positionAdd"> 
                @csrf
                  <div class="form-group">
                    <label for="exampleInputEmail1">Position Name</label>
                    <input type="text" class="form-control" name="position" id="exampleInputEmail1">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Department</label>
                      <input type="text" class="form-control" name="department" id="exampleInputEmail1">
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                  </div>
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="document.getElementById('positionAdd').submit()">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <!--Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Update Position</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form method="POST" id="positionUpdate"> 
                @method('PUT')
                @csrf
                  <div class="form-group">
                    <label for="exampleInputEmail1">Position Name</label>
                    <input type="text" class="form-control" name="position" id="positionName">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Department</label>
                      <input type="text" class="form-control" name="department" id="positionDepartment">
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control" name="description" id="positionDescription" rows="3"></textarea>
                  </div>
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="document.getElementById('positionUpdate').submit()">Update</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Position</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" id="deleteForm">
              @method('DELETE')
              @csrf
                <div class="container">
                  <p>Are you sure you want to delete this position?</p>
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
</div>


<script>
  $(document).ready(function(){
    $('.delete-position').each(function() {
      $(this).click(function(event){
        $('#deleteForm').attr("action", "/position/delete/"+$(this).data('positionid')+"")
      })
    })
    $('.edit-position').each(function() {
      $(this).click(function(event){
        $('#positionUpdate').attr("action", "/position/update/"+$(this).data('positionid')+"");
        $('#positionName').val($(this).data('position'));
        $('#positionDepartment').val($(this).data('department'));
        $('#positionDescription').val($(this).data('description'));
      })
    })
  });
</script>
@endsection
