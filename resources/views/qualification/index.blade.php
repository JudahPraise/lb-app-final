@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Qualification</h3>
    @component('components.alerts')@endcomponent
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
              <span>{{ __('Available Qualifications') }}</span>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add</button>
          </div>
          <div class="card-body">
            <div class="container">
              <div class="row py-2">
                @forelse ($qualifications as $qualification)
                  <div class="col-md-4 mb-3">
                    <div class="card h-100">
                      <div class="card-body">
                        <h5 class="card-title font-weight-bold d-flex justify-content-between">
                          <span>
                            {{ $qualification->title }}
                          </span>
                          <span>
                            <div class="btn dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis-v"></i>
                            </div>
                            <div class="dropdown-menu">
                              <a class="dropdown-item edit-skill" href="{{ route('qualification.edit', $qualification->id) }}" id="skillEdit">Edit</a>
                              <a class="dropdown-item delete-qualification"
                              id="skillDelete"
                              data-toggle="modal" data-target="#deleteModal"
                              data-qualificationid="{{ $qualification->id }}"
                              >Delete</a>
                            </div>
                          </span>
                        </h5>
                        <strong>Qualified Options</strong>
                        <ul>
                            @foreach ($qualification->options as $option)
                                <li>{{ $option['option'] }}</li>
                            @endforeach
                        </ul>
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
    <!-- Modal Add -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Qualification</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('qualification.store') }}" method="POST" id="qualificationAdd"> 
                  @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Qulification Title</label>
                      <input type="text" class="form-control" name="title" id="exampleInputEmail1">
                    </div>
                    <div class="form-group inputs_div">
                        <div class="form-row mb-3 d-flex align-items-end">
                            <div class="col-8">
                                <label for="exampleInputEmail1">Qualified Option</label>
                                <small class="text-success font-italic"><span class="text-danger">*</span>Start from least</small>
                                <input type="number" class="form-control" name="options[{{ 0 }}][point]" value="{{ 10 }}" id="exampleInputEmail1" hidden>
                                <input type="text" class="form-control" name="options[{{ 0 }}][option]"  id="exampleInputEmail1">
                            </div>
                            <button type="button" class="btn btn-success add">Add option</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="document.getElementById('qualificationAdd').submit()">Save changes</button>
            </div>
          </div>
      </div>
    </div>
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Qualification</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" id="deleteForm">
              @method('DELETE')
              @csrf
                <div class="container">
                  <p>Are you sure you want to delete this item?</p>
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
<script src="{{ asset('jquery/jquery.js') }}"></script>
<script>
  $(document).ready(function(){
    var i = 0;
    var value = 10;
    $(this).on("click", ".add", function(){
      i ++;
      value += 10;
      var html = '<div class="form-row mb-3 d-flex align-items-end"><div class="col-8"><label for="exampleInputEmail1">Qualified Option</label><small class="text-success font-italic"><span class="text-danger">*</span>Start from least</small><input type="number" class="form-control" name="options[ '+ i +' ][point]" value='+ value +' id="exampleInputEmail1" hidden><input type="text" class="form-control" name="options[ '+ i +' ][option]"  id="exampleInputEmail1"></div><button class="btn btn-danger remove ">Remove Option</button></div>'
      console.log('get');
      $('.inputs_div').append(html);
    // console.log('hello');
    });
    $(this).on("click", ".remove", function(){
      var target_input = $(this).parent();
        target_input.remove();
    });
    $('.delete-qualification').each(function() {
      $(this).click(function(event){
        $('#deleteForm').attr("action", "/qualification/delete/"+$(this).data('qualificationid')+"")
      })
    })
  });
</script>
@endsection
