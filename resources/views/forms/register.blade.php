@extends('..layouts.formTemplate')

@section('content')
<div class="container-sm">
    <h3 class="mar-v-20">Registrar</h3>
    <form action="/register" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Nome</label>
            <input name="name" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Senha</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Confirmar Senha</label>
            <input name="password_confirmation" type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Criar Conta</button>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection