@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')
    <div id="search-container" class="col-md-12">
        <h1>Busque um evento</h1>
        <form action="/" method="GET" class="input-group">
            <input type="text" name="search" id="search" class="form-control" placeholder="Procurar.....">
            <input type="submit" id="search-submit" class="btn btn-outline-secondary" value="Pesquisar" >
        </form>
    </div>
    <div id="events-container" class="col-md-12">
        @if ($search)
            <h2>Buscando por: {{ $search }}</h2>
        @else
            <h2>Próximos eventos</h2>
            <p class="subtitle">Veja os eventos dos próximos dias</p>
        @endif
        <div id="cards-container" class="row text-white">
            @foreach($events as $event)
            <div class="card col-md-3">
                <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}">
                <div class="card-body">
                    <p class="card-date">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                    <h5 class="card-title">{{ $event->title }}</h5>
                    <p class="card-participants">X Participantes</p>
                    <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber mais</a>
                </div>
            </div>

            @endforeach
            @if (count($events) == 0 && $search)
                <h3 class="text-danger">Não foi possível encontrar nenhum evento com {{ $search }} ! <a class="btn btn-success" href="/">Ver todos</a></h3>
            @elseif (count($events) == 0)
                <h3 class="text-danger">Não há eventos disponíveis</h3>
            @endif
        </div>
    </div>

@endsection
