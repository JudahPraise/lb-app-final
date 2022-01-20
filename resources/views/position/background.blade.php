@extends('position.show')

@section('qualifications')
    @forelse ($qualified as $data)
        <span>
            <strong>{{ $data->qualification->title }}</strong>
            <div class="btn dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
              </div>
              <div class="dropdown-menu">
                  <form action="{{ route('setQualifcation.delete', $data->qualification->id) }}" method="POST" id="deleteQualification">
                    @csrf
                    @method('DELETE')
                </form>
                <a class="dropdown-item delete-position"
                id="skillDelete" onclick="document.getElementById('deleteQualification').submit()">Delete</a>
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
@endsection