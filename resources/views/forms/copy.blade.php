@extends('..layouts.formTemplate')

@section('copyContent')
<form id="copy-form" action="/event/copy/" method="POST">
    @csrf

    <div class="form-group">
        <label for="date">Copiar Para</label>
        <input id="event-date" name="date" type="date" class="form-control">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Copiar Evento</button>
    </div>
</form>
@endsection