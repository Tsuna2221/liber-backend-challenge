@extends('..layouts.formTemplate')

@section('eventContent')
<form id="event-form" action="/event" method="POST">
    @csrf

    <div class="form-group">
        <label for="title">Título</label>
        <input id="event-title" name="title" type="text" class="form-control">
    </div>
    <div class="form-group">
        <label for="description">Descrição</label>
        <input id="event-description" name="description" type="text" class="form-control">
    </div>
    <div class="form-group">
        <label for="date">Data</label>
        <input id="event-date" name="date" type="date" class="form-control">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Salvar Evento</button>
    </div>
</form>
@endsection