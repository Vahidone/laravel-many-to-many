@extends('layouts.admin')


@section('content')

    @include('admin.partials.functions')


    <main class="main-csm">
        <h1 class="text-white fw-bold mb-5">Project List</h1>

        @if ($errors->any())


            <div class="alert alert-warning" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        @endif


        @if (session('error'))
            <div  class="alert-message alert alert-warning" role="alert">
                {{ session('error') }}
            </div>

        @endif

        @if (session('success'))

            <div class="alert-message alert alert-success" role="alert">
                {{ session('success') }}
            </div>

        @endif




        <table class="table table-dark table-striped text-center table_bg_csm">
            <thead>
                <tr>
                    <th class="fw-bold fs-5" style="width: 70px;">
                        <a class="text-white text-decoration-none" href="{{ route('admin.order-by', ['direction' =>$direction, 'column' =>'id'])}}">ID <i class="fa-solid fa-caret-down"></i></a>
                    </th>
                    <th class="fw-bold fs-5">
                        <a class="text-white text-decoration-none" href="{{ route('admin.order-by', ['direction' =>$direction, 'column' =>'title'])}}">Title <i class="fa-solid fa-caret-down"></i></a>
                    </th>
                    <th class="fw-bold fs-5">Description</th>
                    <th class="fw-bold fs-5" style="width: 80px;">
                        <a class="text-white text-decoration-none" href="{{ route('admin.order-by', ['direction' =>$direction, 'column' =>'release_date'])}}">Date <i class="fa-solid fa-caret-down"></i></a>
                    </th>
                    <th class="fw-bold fs-5">Type</th>
                    <th class="fw-bold fs-5">Technology</th>
                    <th class="fw-bold fs-5">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->release_date }}</td>
                    <td>{{ $project->type?->title ?? '-' }}</td>
                    <td>

                        @forelse ($project->technologies as $technology)

                            <span><a class="badge text-bg-info text-white text-decoration-none" href="{{ route('admin.project-technology', $technology)}}">{{ $technology->name }}</a></span>

                        @empty
                        <a class="badge text-bg-info text-white text-decoration-none" href="{{ route('admin.no-Technologies')}}">No technologies</a>
                        @endforelse


                    </td>
                    <td style="width: 170px">

                        <a class="btn btn-success" href="{{ route('admin.projects.show', $project)}}"><i class="fa-regular fa-eye"></i></a>
                        <a class="btn btn-outline-warning" href="{{ route('admin.projects.edit', $project)}}"><i class="fa-solid fa-pen-to-square"></i></a>

                        @include('admin.partials.form-delete', [
                            'route' => route('admin.projects.destroy', $project),
                            'message' => 'sei sicuro di voler eliminare questo progetto?'
                        ])

                    </td>


                </tr>
                @endforeach


            </tbody>
        </table>



        {{ $projects->links() }}



    </main>



@endsection
