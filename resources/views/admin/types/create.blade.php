@extends('layouts.admin')

@section('content')

<div class="container">
  
  <h1>Aggiungi una tipologia</h1>

  <form action="{{route('admin.types.store')}}" method="POST">
    @csrf

    <div class="mb-3">
      <label for="title">Nome</label>
      <input class="form-control @error('title') is-invalid @enderror" type="text" id="name" name="name" value="{{old('name')}}">
      @error('name')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>


    <div class="mb-3">
      <label for="description">Descrizione</label>
      <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10">{{old('description')}}</textarea>
      @error('description')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">
      Aggiungi
    </button>

  </form>
</div>
@endsection