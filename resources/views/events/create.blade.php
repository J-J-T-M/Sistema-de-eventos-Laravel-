@extends('layouts.main')

@section('title', 'Criar Evento')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Crie seu evento</h1>
    <form action="/events" method="POST" enctype="multipart/form-data">
        @csrf 
        <div class="form-group">
            <label for="image">Imagem do Evento :</label>
            <input type="file" id="image" name="image" class="form-control-file">
        </div>
        <div class="form-group">
            <label for="title">Evento :</label>
            <input id="title" class="form-control" type="text" name="title" placeholder="Nome do evento">
        </div>
        <div class="form-group">
            <label for="city">Cidade :</label>
            <input id="city" class="form-control" type="text" name="city"  placeholder="Cidade do evento">
        </div>
        <div class="form-group">
            <label for="private">O evento é privado?</label>
                <select id="private" class="form-control" name="private">
                    <option value="0">Não</option>
                    <option value="1">Sim</option>
                </select>
        </div>
        <div class="form-group">
            <label for="description">Descrição :</label>
            <input id="description" class="form-control" type="textarea" name="description"  placeholder="Descrição do evento">
        </div>
        <input type="submit" class="btn btn-primary" value="Criar Evento">
    </form>
</div>

@endsection