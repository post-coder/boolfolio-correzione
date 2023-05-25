@extends('layouts.admin')

@section('content')

<div class="container">
  <h1>Tutti i progetti</h1>

  <table class="table table-striped">

    <thead>
      <th>Titolo</th>
      <th>Repo</th>
      <th>Descrizione</th>
      <th></th>
    </thead>

    <tbody>
      @foreach($projects as $project)
      <tr>
        <td>{{$project->title}}</td>
        <td>{{$project->repo}}</td>
        <td>{{ substr($project->description,0,50)."..."}}</td>
        <td><a href="{{route('admin.projects.show', $project)}}">Apri</a> </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="d-flex justify-content-center py-3">
    <a href="{{route('admin.projects.create')}}" class="btn btn-primary">Crea un progetto</a>
  </div>
</div>

@endsection