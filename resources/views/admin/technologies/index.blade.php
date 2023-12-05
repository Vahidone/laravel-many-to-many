@extends('layouts.admin')


@section('content')

    @include('admin.partials.functions')

    <main class="main-csm">


        <h1 class="text-white fw-bold mb-4">Technologies</h1>


        @if ($errors->any())


            <div class="alert-message alert alert-warning" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        @endif


        @if (session('error'))
            <div class="alert-message alert alert-warning" role="alert">
                {{ session('error') }}
            </div>

        @endif

        @if (session('success'))

            <div class="alert-message alert alert-success" role="alert">
                {{ session('success') }}
            </div>

        @endif


        <form action="{{ route('admin.technologies.store')}}" method="POST" class="mb-5">
            @csrf

            <div class="input-group mb-3 mt-4">
                <input type="text" class="form-control" placeholder="New technology" name="name">
                <button class="btn btn-primary" type="submit" id="button-addon2">Add</button>
            </div>
        </form>




        <table class="table table-striped table-dark table_bg_csm">
            <thead>
                <tr>
                    <th class="fs-5 fw-bold">Name</th>
                    <th class="fs-5 fw-bold">Action</th>

                </tr>
            </thead>

            <tbody>

                @foreach ($technologies as $technology)

                    <tr>

                        <td>
                            <form action="{{ route('admin.technologies.update', $technology)}}" method="POST" id="form-edit-{{ $technology->id}}">
                                @csrf
                                @method('PUT')


                                <input type="text" class="form-hidden bg-transparent text-white" value="{{ $technology->name}}" name="name">

                            </form>
                        </td>


                        <td>

                            <button onclick="submitForm({{ $technology->id}})" class="btn btn-outline-warning"><i class="fa-solid fa-pen-to-square"></i></button>

                            @include('admin.partials.form-delete', [
                            'route' => route('admin.technologies.destroy', $technology),
                            'message' => 'sei sicuro di voler eliminare questa technologia?'
                            ])


                        </td>

                    </tr>

                @endforeach


            </tbody>
        </table>





    </main>

    <script>

        function submitForm(id) {
            const form = document.getElementById('form-edit-' + id);
            form.submit();

        }
    </script>



@endsection
