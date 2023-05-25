@extends('layouts.admin')

@section('content')

<div class="container">
  
  <h1>Modifica il progetto</h1>

  <form action="{{route('admin.projects.update', $project)}}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="title">Titolo</label>
      <input class="form-control @error('title') is-invalid @enderror" type="text" id="title" name="title" value="{{old('title', $project->title)}}">
      @error('title')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="repo">Repo</label>
      <input class="form-control @error('repo') is-invalid @enderror" type="text" id="repo" name="repo" value="{{old('repo', $project->repo)}}">
      @error('repo')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="type_id">Tipologia</label>

      <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @enderror">
        <option value="">Nessuna</option>
        @foreach ($types as $type)
          <option value="{{$type->id}}" {{old('type_id', $project->type_id) == $type->id ? 'selected' : ''}}>{{$type->name}}</option>
        @endforeach
      </select>
      @error('type_id')
        <div class="invalid-feedback">

          {{$message}}
        </div>
      @enderror

    </div>


    <div class="mb-3 form-group">
      <h4>Tecnologie</h4>

      <div class="form-check">
        @foreach($technologies as $technology)
          @if($errors->any())
            <input id="technology_{{$technology->id}}" name="technologies[]" type="checkbox" value="{{$technology->id}}" @checked(in_array($technology->id, old('technologies', [])))>
          @else
            <input id="technology_{{$technology->id}}" name="technologies[]" type="checkbox" value="{{$technology->id}}" @checked($project->technologies->contains($technology->id))>
          @endif

          <label for="technology_{{$technology->id}}">{{$technology->name}}</label>
        @endforeach
      </div>
      @error('technologies') 
        <div class="text-danger">
          {{$message}}
        </div>
      @enderror

    </div>


    <div class="mb-3">
      <label for="description">Descrizione</label>
      <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10">{{old('description', $project->description)}}</textarea>
      @error('description')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">
      Modifica
    </button>

  </form>
</div>
@endsection