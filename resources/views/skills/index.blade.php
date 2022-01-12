@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Skills</h3>
    @component('components.alerts')@endcomponent
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>{{ __('Test Questions') }}</span>
                    <button type="button" class="btn btn-primary" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSkillModal">Add</button>
                </div>
                <div class="card-body">
                  <div class="container">
                    <div class="row py-2">
                      @forelse ($skills as $skill)
                      <div class="col-md-4 mb-3">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title d-flex justify-content-between">
                              <span>{{ $skill->skill_title }}</span>
                              <span>
                                <div class="btn dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-ellipsis-v"></i>
                                </div>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item edit-skill" id="skillEdit" 
                                  data-skillid="{{ $skill->id }}" 
                                  data-title="{{ $skill->skill_title }}" 
                                  data-description="{{ $skill->description }}"
                                  data-toggle="modal" data-target="#editSkillModal"
                                  >Edit</a>
                                  <a class="dropdown-item delete-skill"
                                  id="skillDelete"
                                  data-skillid="{{ $skill->id }}" 
                                  data-toggle="modal" 
                                  data-target="#deleteModal"
                                  >Delete</a>
                                </div>
                              </span>
                            </h5>
                            <p class="card-text">{{ $skill->description }}</p>
                            <a href="{{ route('skill.show', $skill->id) }}" class="btn btn-primary">Show</a>
                            <a href="{{ route('skill.show', $skill->id) }}" class="btn btn-primary">Set Questions</a>
                          </div>
                        </div>
                      </div>
                      @empty
                        <div class="container">
                          <div class="row py-2">
                              <div class="container-fluid d-flex flex-column align-items-center" data-toggle="modal" data-target="#exampleModal">
                                <img src="{{ asset('svg/undraw_add.svg') }}" alt="" srcset="" height="250" width="250">
                                <span>Add Position</span>
                              </div>
                          </div>
                        </div>
                      @endforelse
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
  
    <!--Add Modal -->
    <div class="modal fade" id="addSkillModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Skill</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <form action="{{ route('skill.store') }}" method="POST" id="addSkillForm">
                    @csrf
                      <div class="form-group">
                        <label for="skill_title">Title</label>
                        <input type="text" class="form-control" name="skill_title" id="skill_title">
                      </div>
                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                      </div>
                  </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="document.getElementById('addSkillForm').submit()">Save</button>
            </div>
        </div>
      </div>
    </div>

    <!--Edit Modal -->
    <div class="modal fade" id="editSkillModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Skill</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <form method="POST" id="editSkillForm">
                    @method('PUT')
                    @csrf
                      <div class="form-group">
                        <label for="skill_title">Title</label>
                        <input type="text" class="form-control" name="skill_title" id="skillTitle">
                      </div>
                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="skillDescription" rows="3"></textarea>
                      </div>
                  </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="document.getElementById('editSkillForm').submit()">Save</button>
            </div>
        </div>
      </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Skill</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" id="deleteSkillForm">
              @method('DELETE')
              @csrf
                <div class="container">
                  <p>Are you sure you want to delete this skill?</p>
                  <p><span class="text-danger">*</span>by deleting a skill will also remove the set of questions assigned for this skill</p>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" onclick="document.getElementById('deleteSkillForm').submit()">Delete</button>
          </div>
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function(){
        $('.edit-skill').each(function() {
          $(this).click(function(event){
            $('#editSkillForm').attr("action", "/skills/update/"+$(this).data('skillid')+"")
            $('#skillTitle').val($(this).data('title'));
            $('#skillDescription').val($(this).data('description'));
          })
        })
        $('.delete-skill').each(function() {
          $(this).click(function(event){
            $('#deleteSkillForm').attr("action", "/skills/delete/"+$(this).data('skillid')+"")
          })
        })
      });
    </script>

@endsection
