@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<main>
  <div class="photo">
    <img id="previewImage" src="{{$user->profilePhotos()->first()->profile_photo_path}}" alt="Not found">
  </div>
    <div class="form">
      <form class="form-elements" action="{{route('profile.update',$user)}}" method="post" enctype="multipart/form-data">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" value="{{$user->name}}" required>
        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" value="{{$user->email}}" required>
        <label for="inputImagen">Imagen:</label>
        <input type="file" name="imagen" id="inputImagen" accept="image/*" onchange="previsualizarImagen()">
        <label for="password">Contraseña anterior:</label>
        <input type="password" id="password" name="password" placeholder="Contraseña anterior" required>
        <label for="newpassword">Nueva contraseña:</label>
        <input type="password" id="newpassword" name="newpassword" placeholder="Nueva contraseña" required>
        <label for="telephone">Telefono:</label>
        <input type="number" id="telephone" name="telephone" placeholder="Numero de telefono" value="{{$user->numberContacts()->first()->number}}" required>
        @if (isset($mensaje))
        <p style="color:red">
         Datos introducidos incorrectos
        </p>                
        @endif
        <input class="btn btn-primary" type="submit" value="Guardar cambio">
        @csrf
        @method('POST')
        @if ($user->roles->first()->name == 'Fotografo')
           <a class="btn btn-secondary" href="{{url('/select-rol/0')}}">
            Cambiar a organizador
           </a>
        @else
        <a class="btn btn-green" href="{{url('/select-rol/1')}}">
            Cambiar a Fotografo
           </a>
        @endif
            
        
      </form>
  </div>
</main>
@stop

@section('css')
    <link rel="stylesheet" href="/css/profile-form.css">
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
