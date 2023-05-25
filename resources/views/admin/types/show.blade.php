@extends('layouts.admin')


@section('content')
    <div class="container">
      <h1>Tipologia </h1>
      <hr>
      <h3>Progetti collegati</h3>
      <table class="table table-striped">

        <thead>
          <th>Nome</th>
          <th></th>
        </thead>

        <tbody>
          @foreach ($type->projects as $project)
              <tr>
                <td>{{$project->title}}</td>
                <td><a href="{{route('admin.projects.show', $project)}}">Mostra</a></td>
              </tr>
          @endforeach
        </tbody>
      </table>
    </div>
@endsection