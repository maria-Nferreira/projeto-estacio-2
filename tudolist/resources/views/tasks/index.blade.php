@extends('base.base')

@section('title')
Lista de Tarefas
@endsection

@section('content')
<div class='d-flex justify-content-center pt-5'>
<form method="POST">
  @if(session()->has('sucesso')) 
    <div class="alert alert-primary" role="alert">
        {{session()->get('sucesso')}}
    </div>
  @endif
  @csrf
  <div class="mb-3">
    <label class="form-label">Nome da Tarefa</label>
    <input value="{{ @old('name') }}" name='name' type="text" class="form-control" placeholder="Adicionar tarefa">
    @error('name')
      <div class="form-text">{{$message}}</div>
    @enderror
  </div>
  <div class="mb-3">
    <label class="form-label">Descrição</label>
    <textarea name="description" cols='2' class="form-control" placeholder="Descreva a Tarefa">{{ @old('description') }}</textarea>
    @error('description')
      <div class="form-text">{{$message}}</div>
    @enderror
  </div>
  <div class="mb-3">
    <label class="form-label">Data</label>
    <input value="{{ @old('date') }}" name="date" type="date" class="form-control">
    @error('date')
      <div class="form-text">{{$message}}</div>
    @enderror
  </div>
  <div class="d-grid">
    <button type="submit" class="btn btn-primary">Adicionar</button>
  </div>
  </form>
</div>
<div class="container">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome da Tarefa</th>
      <th scope="col">Descrição</th>
      <th scope="col">Data</th>
      <th scope="col">Staus</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach($tasks as $key => $task)
    <tr>
      <th scope="row">{{$key + 1}}</th>
      <td>{{$task -> name}}</td>
      <td>{{$task -> description}}</td>
      <td>{{$task -> date}}</td>
      <td>
        <button class=" btn {{$task -> status ? 'btn-success' : 'btn-danger'}}">{{$task -> status ? 'Realizada' : 'Não realizada'}}</button>
      </td>
      <td class="d-flex">
        <a href="{{route('tasks.edit',$task -> id)}}" class="btn btn-warning">Editar</a>
        <form method="POST" action="{{route('tasks.destroy', $task -> id)}}">
          @method('DELETE')
          @csrf
          <button class="btn btn-danger">Excluir</button> 
        </form>
      <td>  
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection