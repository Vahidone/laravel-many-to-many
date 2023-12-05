@extends('layouts.admin')

@section('content')

    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success')}}
        </div>
    @endif

    <div class="main-csm">
        <h1 class="text-white mb-5">Projects for Type List</h1>

        <div class="accordion accordion-transparent" id="accordionExample">
            @foreach ($types as $type)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading-{{ $type->id }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $type->id }}" aria-expanded="true" aria-controls="collapse-{{ $type->id }}">
                            {{ $type->title}}
                        </button>
                    </h2>
                    <div id="collapse-{{ $type->id }}" class="accordion-collapse collapse" aria-labelledby="flush-heading-{{ $type->id }}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul class="list-group">
                                @foreach ($type->projects as $project)
                                    <li class="list-group-item bg-transparent border-0">
                                        <a class="link-type-projects" href="{{ route('admin.projects.show', $project)}}">{{ $project->title }} <i class="fa-solid fa-up-right-from-square"></i></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
