
@extends('layouts.admin')

@section('content')

@include('admin.partials.functions')

<main class="main-csm w-100">

    <h1 class="text-white fw-bold mb-5">Types</h1>

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
        <div  class="alert-message alert alert-warning" role="alert">
            {{ session('error') }}
        </div>

    @endif

    @if (session('success'))

        <div  class="alert-message alert alert-success" role="alert">
            {{ session('success') }}
        </div>

    @endif



    <form action="{{ route('admin.types.store')}}" method="POST" class="mb-5">
        @csrf

        <div class="input-group mb-3 mt-4">
            <input type="text" class="form-control" placeholder="New type" name="title">
            <button class="btn btn-primary" type="submit" id="button-addon2">Add</button>
        </div>
    </form>



    <table class="table table-dark table-striped table_bg_csm">
        <thead>
            <tr>

                <th class="fs-5 fw-bold">Title</th>
                <th class="fs-5 fw-bold">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
            <tr>

                <td>
                    <form action="{{ route('admin.types.update', $type)}}" method="POST" id="forma-edit-{{ $type->id}}">
                        @csrf
                        @method('PUT')


                        <input type="text" class="form-hidden bg-transparent text-white" value="{{ $type->title}}" name="title">

                    </form>
                </td>


                <td>

                    <button onclick="submitForm({{ $type->id}})" class="btn btn-outline-warning"><i class="fa-solid fa-pen-to-square"></i></button>

                   @include('admin.partials.form-delete', [
                    'route' => route('admin.types.destroy', $type),
                    'message' => 'sei sicuro di voler eliminare questa type?'
                   ])


                </td>


            </tr>
            @endforeach


        </tbody>

    </table>



</main>

<script>

    function submitForm(id) {
        const form = document.getElementById('forma-edit-' + id);
        form.submit();

    }
</script>


@endsection
