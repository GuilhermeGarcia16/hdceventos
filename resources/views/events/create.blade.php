@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')
<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Crie seu evento</h1>
  <form action="/events/store" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="image">Imagem do evento:</label>
      <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <div class="form-group">
      <label for="title">Evento:</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento">
    </div>
    <div class="form-group">
      <label for="description">Descrição:</label>
      <textarea type="text" class="form-control" id="description" name="description">
      </textarea>
    </div>
    <div class="form-group">
      <label for="">Cidade:</label>
      <input type="text" class="form-control" id="city" name="city" placeholder="Cidade">
    </div>
    <div class="form-group">
      <label for="title">Privado:</label>
        <select name="private" id="private" class="form-control">
          <option value="0"> Sim </option>
          <option value="1"> Não </option>
        </select>
    </div>
    <input type="submit" class="btn-primary" value="Criar evento"/>
  </form>
</div>
@endsection
