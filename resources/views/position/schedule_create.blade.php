@extends('position.create')

@section('qualification.create')
<form action="{{ route('interview.store') }}" method="POST" id="schedForm">
    @csrf
    <div class="form-group">
        <label for="exampleFormControlSelect1">Position</label>
        <select class="form-control"  name="position_id" id="exampleFormControlSelect1">
            {{-- <option >Select Position</option> --}}
            <option value="{{ $position->id }}" selected>{{ $position->position }}</option> 
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
    <button type="submit" class="btn btn-primary float-right">Save</button>
</form>
@endsection