@extends('layouts.main')

@section('title', $event->title)

@section('content')

<div class="col-md-10 offset-md-1">
    <div class="row">
        <div id="image-container" class="col-md-6">
            <img src="/storage/img/events/{{$event->image}}" class="img-fluid" alt="{{$event->title}}">
        </div>
        <div id="info-container" class="col-md-6">
            <h1>{{$event->title}}</h1>
            <p class="event-city"> <icon-icon name="location-outline"></icon-icon>{{$event->city}} </p>
            <p class="events-participants"><icon-icon name="people-outline"></icon-icon> X participantes</p>
            <p class="event-owner"><icon-icon name="star-outline"></icon-icon>Dono do evento</p>
            <a href="#" class="btn btn-primary" id="event-submit">Confirmar presença </a>
        </div>
        <div class="col-md-12" id="description-container">
            <h3> Sobre o evento </h3>
            <p class="event-description">{{$event->description}}</p>
        </div>
    </div>
</div>

@endsection