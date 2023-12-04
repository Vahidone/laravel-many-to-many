@extends('layouts.admin')



@section('content')



 <div class="main-csm">

        <h1 class="text-white mb-5">Elenco progetti relativi al {{ $technology->name}}</h1>

        <table class="table table-dark table-striped text-center">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Project name</th>

            </tr>
            </thead>
            <tbody>

            @foreach ($technology->projects as $project)

                <tr>

                    <td>{{ $project->id }}</td>
                    <td>{{ $project->title }}</td>

                </tr>

            @endforeach




            </tbody>
        </table>



 </div>





@endsection
