@extends('layouts.main')

@section('title', 'Editando '. $event->title)

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Editando: {{ $event->title }}</h1>
    <form action="/events/update/{{ $event->id }}" method="POST" enctype="multipart/form-data">
        @csrf 
        @method('PUT')
        <div class="form-group">
            <label for="image">Imagem do Evento :</label>
            <input type="file" id="image" name="image" class="form-control-file">
            <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="img-preview">
        </div>
        <div class="form-group">
            <label for="title">Evento :</label>
            <input id="title" class="form-control" type="text" name="title" placeholder="Nome do evento" value="{{ $event->title }}">
        </div>
        <div class="form-group">
            <label for="date">Data do evento :</label>
            <input id="date" class="form-control" type="date" name="date" value="{{ $event->date->format('Y-m-d') }}">
        </div>
        <div class="form-group">
            <label for="city">Cidade :</label>
            <input id="city" class="form-control" type="text" name="city"  placeholder="Cidade do evento" value="{{ $event->city }}">
        </div>
        <div class="form-group">
            <label for="private">O evento é privado?</label>
                <select id="private" class="form-control" name="private">
                    <option value="0">Não</option>
                    <option value="1" {{ $event->private == 1 ? "selected='selected'" : "" }}>Sim</option>
                </select>
        </div>
        <div class="form-group">
            <label for="description">Descrição :</label>
            <textarea id="description" class="form-control" name="description"  placeholder="Descrição do evento">{{ $event->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="items">Adicione itens de infraestrutura :</label>
           <div class="form-group">
            <input type="checkbox" name="items[]" value="Cadeiras" > Cadeiras
           </div>
           <div class="form-group">
            <input type="checkbox" name="items[]" value="Palco" > Palco
           </div>
           <div class="form-group">
            <input type="checkbox" name="items[]" value="Cerveja gratis" > Cerveja grátis
           </div>
           <div class="form-group">
            <input type="checkbox" name="items[]" value="Open Food" > Open food
           </div>
           <div class="form-group">
            <input type="checkbox" name="items[]" value="Brindes" > Brindes
           </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Editar Evento">
    </form>
</div>

@endsection