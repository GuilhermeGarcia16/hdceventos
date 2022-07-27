@extends('layouts.main')

@section('title', 'Editar evento')

@section('content')
    <form action="/events/update/{{$event->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-4">
                <label style="font-weight: bold;"> Nome do evento</label>
                <input type="text" class="form-control" value="{{$event->title}}" name="event"/>
                <label style="font-weight: bold;"> Cidade</label>
                <input type="text" class="form-control" value="{{$event->city}}" name="city" />
            </div>
            <div class="form-group col-md-2">
                <input type="file" class="form-control-file" name="image" >
                <img src="/storage/img/events/{{$event->image}}" alt="{{$event->title}}" class="img-edit">
            </div>
            <div class="form-group col-md-4">
                <label style="font-weight: bold;"> Descrição do evento</label>
                <textarea class="form-control" name="description" rows="3">{{$event->description}}</textarea>
            </div>
            <div class="form-group col-md-2">
               <label>Privado?</label>
               <select name="private" class="form-control">
                    @if($event->private == true)
                    <option name="private" value="true" selected>Sim</option>
                    <option name="private" value="false"> Não </option>
                    @else
                    <option name="private" value="true">Sim</option>
                    <option selected  name="private" value="false"> Não </option>
                    @endif
               </select>
            </div>
                <div class="form-check">
                    <label for="description">Itens de infraestrutura:</label>
                    <div class="form-group">
                        <input type="checkbox" name="items[]" value="Cadeiras" /> Cadeiras
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="items[]" value="Palco" /> Palco
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="items[]" value="Open Bar" /> Open Bar
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="items[]" value="Open food" /> Open food
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="items[]" value="Brindes" /> Brindes
                </div>
            <input type="submit" class="btn btn-primary" value="Atualizar" />
            </div>    
        </div>
    </form>
@endsection