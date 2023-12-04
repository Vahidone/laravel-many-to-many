
@extends('layouts.admin')

@section('content')


    <div class="main-csm text-white">

        <h1 class="mb-5">{{ $project->title }} <a class="btn btn-warning ms-2" href="{{ route('admin.projects.edit', $project)}}"><i class="fa-solid fa-pen-to-square"></i></a>
        <a class="btn btn-secondary" href="{{ route('admin.projects.index')}}">Back</a>
        </h1>

        @if($project->type)
            <p class="mb-4">Type: <strong>{{ $project->type->title}}</strong></p>
        @endif

        @forelse ($project->technologies as $technology)

            <span class="badge text-bg-info">{{ $technology->name }}</span>

            @empty

            <span class  ="badge text-bg-warning">Non sono presenti Technology</span>

        @endforelse


        <div class="w-50 mb-4">
            <img class="img-fluid mb-4" src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
        </div>

        <p class="mb-4"><strong>{{ $project->text }}</strong></p>
        <p class="mb-4">Data: <strong>{{ $project->release_date }}</strong></p>
        <p class="mb-4">Description: <strong>{{ $project->description }}</strong></p>


    </div>







@endsection
