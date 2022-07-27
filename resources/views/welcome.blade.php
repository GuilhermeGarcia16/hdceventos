@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')
<div id="search-container" class="col-md-12">
        
        <div class="back_image">
        <h1 id="search_title">Busque um evento</h1>
        <form action="/" method="GET">
                <input type="text" id="search" name="search" class="form-control-lg" placeholder="Pesquise.."/>
        </form>
                <img src="/img/event.jpg" class="rounded mx-auto d-block">    
        </div>
</div>
<div id="events-container" class="col-md-12">
        @if(!$search)
        <h2>Próximos eventos</h2>
        <p> Veja os eventos dos próximos dias</p>
        <div id="cards-container" class="row">
        @else
        <p>Buscado por: <strong>{{$search}}</strong></p>
        @endif
        @if(count($events) > 0)
          @foreach($events as $event)
                <div class="card col-md-3">
                   <img src="storage/img/events/{{$event->image}}" alt="{{ $event->title }}">
                   <div class="card-body">
                        <p class="card-date">10/09/2022</p>
                        <h5 class="card-title">{{$event->title}}</h5>
                        <p class="card-participants">{{count($event->users)}} participantes</p>
                        <a href="/events/{{$event->id}}" class="btn btn-primary">Saber mais </a>
                   </div>
                </div>
          @endforeach
        @else
        <p> Nenhum evento disponível. <a href="/">Volte para home.</a></p>
        @endif
        </div>
</div>

@endsection
