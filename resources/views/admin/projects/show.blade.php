@extends('layouts.admin')

@section('content')

<div class="container">
  <div class="text-center">
    <img class="w-25" src="{{ asset('storage/' . $project->cover_image) }}" alt="">
  </div>

  <h1>Progetto: {{$project->title}}</h1>
  <h4>Tipologia: {{$project->type ? $project->type->name : 'nessuna'}}</h4>
  <h5>Tecnologie: @foreach ($project->technologies as $technology)
       {{$technology->name . ' '}}
  @endforeach</h5>

  <hr>  
  
  <div class="card">
    <div class="card-title p-3"><h3>Repo:</h3></div>
    <div class="card-body">
      <a href="{{$project->repo}}" target="_blank">Github</a>
    </div>
  </div>

  <hr>

  <p>
    {{$project->description}}
  </p>

  <div class="d-flex justify-content-around">
    <a href="{{route('admin.projects.edit', $project)}}" class="btn btn-secondary">Modifica</a>

    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
      Elimina
    </button>
    
  </div>
  
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteModalLabel">Elimina il progetto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Sei sicuro di voler eliminare il progetto?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
        
        <form action="{{route('admin.projects.destroy', $project)}}" method="POST">
          @csrf
          @method('DELETE')

          <button type="submit" class="btn btn-danger">Elimina</button>
        </form>
      </div>
    </div>
  </div>
</div>


@endsection