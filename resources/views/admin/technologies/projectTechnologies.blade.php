@extends('layouts.admin')



@section('content')



 <div class="main-csm">

    <h1 class="text-white mb-5">Elenco progetti relativi al {{ $technology->name}}</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Project name</th>

        </tr>
        </thead>
        <tbody>
        <tr>
         @foreach ($technology->projects as $project)

            <td>{{ $project->id }}</td>
            <td>{{ $project->title }}</td>

         @endforeach


        </tr>

        </tbody>
    </table>



 </div>





@endsection
