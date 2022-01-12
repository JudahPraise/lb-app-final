@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Qualification</h3>
    @component('components.alerts')@endcomponent
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>{{ __('Edit Qualification') }}</span>
                    <a href="{{ route('qualification.index') }}" class="btn btn-secondary">Back</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('qualification.update', $qualification->id) }}" method="POST" id="qualificationAdd"> 
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Qulification Title</label>
                          <input type="text" class="form-control" name="title" value="{{ $qualification->title }}" id="exampleInputEmail1">
                        </div>
                        <div class="form-group inputs_div">
                            @foreach ($qualification->options as $option)
                                <div class="form-row mb-3 d-flex align-items-end">
                                    <div class="col-8">
                                        <input type="text" class="form-control" name="options[]" value="{{ $option }}" id="exampleInputEmail1">
                                    </div>
                                    <button type="button" class="btn {{ $loop->index == 0 ? 'btn-success add' : 'btn-danger remove' }}">{{ $loop->index == 0 ? 'Add Option' : 'Remove Option' }}</button>
                                </div>
                            @endforeach
                        </div>
                        <button class="btn btn-primary float-right" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  $(document).ready(function(){
    $(this).on("click", ".add", function(){
      var html = '<div class="form-row mb-3 d-flex align-items-end"><div class="col-8"><input type="text" class="form-control" name="options[]" id="exampleInputEmail1"></div><button class="btn btn-danger remove ">Remove Option</button></div>'
      console.log('get');
      $('.inputs_div').append(html);
    // console.log('hello');
    });
    $(this).on("click", ".remove", function(){
      var target_input = $(this).parent();
        target_input.remove();
    });
  });
</script>
@endsection
