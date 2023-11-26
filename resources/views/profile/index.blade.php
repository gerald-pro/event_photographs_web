@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <main>
        <div class="container py-3 px-1">
            <div class="card">
                <div class="card-header">
                    <div class="card-title"></div>
                    Perfil de usuario
                </div>
                <div class="card-body">
                    <div class="row justify-content-center pb-2">
                        <img class="img-fluid img-circle" id="previewImage" src="{{ $user->profile_photo_url }}" alt="Not found"
                            width="200">
                    </div>
                    <hr>
                    <form class="form-elements" action="{{ route('profile.update', $user) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="name">Nombre:</label>
                                <input class="form-control" type="text" id="name" name="name"
                                    value="{{ $user->name }}" required>
                            </div>
                            <div class="col form-group">
                                <label for="email">Correo electrónico:</label>
                                <input class="form-control" type="email" id="email" name="email"
                                    value="{{ $user->email }}" required>
                            </div>
                            <div class="col form-group">
                                <label for="telephone">Telefono:</label>
                                <input class="form-control" type="number" id="telephone" name="telephone"
                                    placeholder="Numero de telefono" value="{{ $user->numberContacts()->first()->number }}"
                                    required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="password">Contraseña anterior:</label>
                                <input class="form-control" type="password" id="password" name="password"
                                    placeholder="Contraseña anterior" required>
                            </div>
                            <div class="col form-group">
                                <label for="newpassword">Nueva contraseña:</label>
                                <input class="form-control" type="password" id="newpassword" name="newpassword"
                                    placeholder="Nueva contraseña" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="inputImagen">Imagen:</label>
                                <input class="form-control" type="file" name="imagen" id="inputImagen" accept="image/*"
                                    onchange="previsualizarImagen()">
                            </div>
                        </div>

                        @if (isset($mensaje))
                            <p style="color:red">
                                Datos introducidos incorrectos
                            </p>
                        @endif
                        <hr>
                        <div class="row justify-content-between">
                            @if ($user->roles->first()->name == 'Fotografo')
                                <a class="btn btn-info" href="{{ url('/select-rol/0') }}">
                                    Cambiar a modo organizador
                                </a>
                            @else
                                <a class="btn btn-info" href="{{ url('/select-rol/1') }}">
                                    Cambiar a modo Fotografo
                                </a>
                            @endif

                            <button class="btn btn-primary" type="submit">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@stop

@section('js')
    <script>
        function previsualizarImagen() {
            var input = document.getElementById('inputImagen');
            var imagen = document.getElementById('previewImage');

            var file = input.files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    imagen.src = e.target.result;
                };

                reader.readAsDataURL(file);
            }
        }

        function enableChangePassword() {
            var element = document.getElementById('password-form-id');
            element.disabled = false;
            element.style.visibility = 'visible';
        }
    </script>
@stop
