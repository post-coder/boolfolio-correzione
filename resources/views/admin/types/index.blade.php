@extends('layouts.admin')


@section('content')
    <div class="container">
      <h1>Tutte le tipologie</h1>

      <table class="table table-striped">

        <thead>
          <th>Nome</th>
          <th>Descrizione</th>
          <th></th>
        </thead>

        <tbody>
          @foreach ($types as $type)
              <tr>
                <td>{{$type->name}}</td>
                <td>{{$type->description}}</td>
                <td><a href="{{route('admin.types.show', $type)}}">Mostra</a></td>
              </tr>
          @endforeach
        </tbody>
      </table>

      <div class="d-flex justify-content-center">
        <a href="{{route('admin.types.create')}}" class="btn btn-primary">Crea una tipologia</a>
      </div>


    </div>
@endsection