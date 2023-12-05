@extends('layouts.admin')

@section('content')

@include('admin.partials.functions')


<div class="main-csm">


    <h1 class="text-white mb-4">{{ $title }}</h1>


    @if($errors->any())
        <div class="alert-message alert alert-danger " role="alert">
            <ul>

                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif



    <div class="row">
    <div class="col-8">
        <form
          action="{{ $route }}"
          method="POST"
          enctype="multipart/form-data"
        >
            @csrf
            @method($method)
            <div class="mb-5">
                <label for="title" class="form-label text-white">Titolo Progetto *</label>
                <input
                  id="title"
                  class="form-control @error('title') is-invalid @enderror"
                  name="title"
                  type="text"
                  value="{{ old('title', $project?->title) }}"
                >
                @error('title')

                    <p class="alert-message text-danger" >{{ $message }}</p>

                @enderror

            </div>



            <div class="mb-3">
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">

                    @foreach ($technologies as $technology)
                        <input
                        type="checkbox" class="btn-check"
                        id="tech_{{ $technology->id }}"
                        autocomplete="off"
                        value="{{ $technology->id }}"
                        name="technologies[]"
                        @if (($errors->any() && in_array($technology->id, old('technologies', [])))
                        || (!$errors->any() && $project?->technologies->contains($technology)))
                            checked
                        @endif
                        >
                        <label class="btn btn-outline-primary text-white" for="tech_{{ $technology->id }}"> {{ $technology->name }}</label>
                    @endforeach
                </div>
            </div>


            <div class="row">

                <div class="col-6">
                    <label for="release_date" class="form-label text-white">Data</label>
                    <input
                      id="release_date"
                      class="form-control @error('release_date') is-invalid @enderror"
                      name="release_date"
                      type="text"
                      value="{{ old('release_date', $project?->release_date) }}"
                    >
                    @error('release_date')
                        <p id="alert-message-p" class="text-danger">{{ $message }}</p>
                    @enderror
                </div>




                <div class="col-6">

                    <label for="type_id" class="form-label text-white">Type</label>

                    <select name="type_id" class="form-select" id="type_id" >
                        <option value="">Select Type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" @if ($type->id === old('type_id', $project?->type?->id)) selected @endif>
                                {{ $type->title }}
                            </option>
                        @endforeach
                    </select>

                </div>

            </div>






            <div class="mb-3">
                <label for="image" class="form-label text-white">Immagine</label>
                <input
                  id="image"
                  class="form-control @error('image') is-invalid @enderror"
                  name="image"
                  type="file"
                  onchange="showImage(event)"
                  value="{{ old('image', $project?->image) }}"
                >
                @error('image')
                    <p class="text-danger">{{ $image }}</p>
                @enderror


                <img id="thumb" width="150" class="mt-4" onerror="this.src='/img/placeholder.png'" src="{{ asset('storage/' . $project?->image) }}"/>

            </div>

            <label for="Descrizione" class="text-white mb-2">Descrizione *</label>
            <div class="form-floating mb-5">

                <textarea class="form-control" placeholder="Descrizione" id="Descrizione" name="description" style="height: 200px">{{ old('description',$project?->description)  }}</textarea>

                @error('description')
                    <p class="alert-message text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Invia</button>
            <button type="reset" class="btn btn-secondary">Annulla</button>

        </form>
    </div>
</div>



</div>

<script>

    function showImage(event) {
        const thumb = document.getElementById('thumb');
        thumb.src = URL.createObjectURL(event.target.files[0]);
    }
</script>





@endsection
