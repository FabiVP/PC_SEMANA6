<!--ahora, extendemo la pantalla creada -->
@extends('layouts.app')
<!-- luego, vamos a personalizar la seccion CONTENT -->
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card border-0 bg-light px-4 py-2">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="card-body">
                            <div class="form-group">
                                <label>Email:</label>
                                <input class="form-control border-0"type="email" name="email" placeholder="tu correo...">
        
                            </div>
                            <div class="form-group">
                                <label>Contraseña:</label>
                                <input class="form-control border-0" type="password" name="password" placeholder="tu clave...">
                                
                            </div>
                        </div>

                        <button class="btn btn-primary btn-block" id="login-btn">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection  
