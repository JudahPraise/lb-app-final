@extends('position.show')

@section('qualifications')
    @forelse ($qualified as $data)
        <span>
            <strong>{{ $data->qualification->title }}</strong>
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