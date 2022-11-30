@extends('base.base')

@section('content')
    <div class="container pt-3">
        <a class="btn btn-primary" href="{{route('tasks.index')}}">Voltar</a> 
    </div>
<div class="container d-flex justify-content-center pt-5">
    <form method="POST" action="{{route('tasks.update', $task->id)}}">
    @method('PUT')
    @if(session()->has('sucesso')) 
        <div class="alert alert-primary" role="alert">
            {{session()->get('sucesso')}}
        </div>
    @endif
    @csrf
    <div class="mb-3">
        <label class="form-label">Nome da Tarefa</label>
        <input value="{{ @old('name') ?? $task -> name }}" name='name' type="text" class="form-control" placeholder="Nome da Tarefa">
        @error('name')
        <div class="form-text">{{$message}}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Descrição</label>
        <textarea name="description" cols='2' class="form-control" placeholder="Descrição da Tarefa">{{ @old('description') ?? $task->description }}</textarea>
        @error('description')
        <div class="form-text">{{$message}}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Completa</label>
        <select name="status" class="form-control">
            <option value="0" @if(!$task->status) selected @endif>incompleta</option>
            <option value="1" @if($task->status) selected @endif>Complata</option>
        </select>   
        @error('status')
        <div class="form-text">{{$message}}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Data</label>
        <input value="{{ @old('date') ?? $task -> date}}" name="date" type="date" class="form-control">
        @error('date')
        <div class="form-text">{{$message}}</div>
        @enderror
    </div>
    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </div>
  </form>

</div>