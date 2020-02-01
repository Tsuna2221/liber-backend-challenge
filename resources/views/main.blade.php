@extends("layouts.mainTemplate")

@section('loggedContent')
    <div class="d-flex a-between mar-t-20">
        <h3>Lista de Eventos</h3>
        <button onclick="handleEvent()" type="button" class="btn btn-primary" data-toggle="modal" data-target="#eventModal">Adicionar Evento</button>

    </div>
    @if($errors->any())
        <div class="alert alert-danger mar-t-14">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif        
    @if(count($events) > 0)
        <ul class="list-group mar-t-30">
            @foreach ($events as $event)
                <li class="list-group-item d-flex a-between a-vertical">
                    <span>{{$event->id}} - <strong>{{$event->title}}</strong> - {{$event->description}}</span>

                    <div class="d-flex a-vertical">
                        <strong>{{str_replace("-", "/", date('d-m-Y', strtotime($event->date)))}}</strong>

                        <button onclick="handleEvent({{$event}})" type="button" class="btn btn-success mar-l-10" data-toggle="modal" data-target="#eventModal">Editar</button>
                        <button onclick="handleCopy({{$event->id}})" type="button" class="btn btn-primary mar-l-10" data-toggle="modal" data-target="#copyEventModal">Copiar</button>
                        <form method="POST" action="/event/{{$event->id}}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <input type="submit" class="btn btn-danger mar-l-6" value="Excluir"/>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <h4 class="txa-center mar-t-30">Nenhuma tarefa encontrada</h4>
    @endif
@endsection