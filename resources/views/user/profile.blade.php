@extends('layouts.app')

@section('content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-xs-12">
                <h2>Mi perfil</h2>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('user.update') }}" role="form" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <labe>Nombre:</labe>
                        <input name="title" type="text" required="required" class="form-control"
                               value="{{ Auth::user()->name }}">
                    </div>
                    <div class="form-group">
                        <labe>Correo electrónico:</labe>
                        <input name="title" type="email" disabled="disabled" required="required" class="form-control"
                               value="{{ Auth::user()->email }}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary pull-right">Actualizar</button>
                        <div class="clearfix"></div>
                    </div>
                </form>

                <h3>Cambiar contraseña</h3>
                <hr>
                <form action="{{ route('user.update') }}" role="form" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <labe>Contraseña actual:</labe>
                        <input name="title" type="password" required="required" class="form-control">
                    </div>
                    <div class="form-group">
                        <labe>Nueva contraseña:</labe>
                        <input name="title" type="password" required="required" class="form-control">
                    </div>
                    <div class="form-group">
                        <labe>Confirmar contraseña:</labe>
                        <input name="title" type="password" required="required" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary pull-right">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
