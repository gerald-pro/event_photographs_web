@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Subir fotos del evento</h1>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
    
            <form action="{{ route('event.gallery.store',$event) }}" method="post" enctype="multipart/form-data" id="image-upload" class="dropzone">
                @csrf
                <div class="form-group">
                    <label for="file">Example file input</label>
                    <input type="file" class="form-control-file" id="file" name="file" required>
                  </div>
              
               <input id="price" name="price" type="number" class="form-control" required placeholder="Ingrese el precio (Bs)" value="5.00">
               <button id="buttonSubmitE" type="submit">Subir Imagenes</button>
            </form>
            
            <div class="buttonSubmit">
               
            </div>
        </div>
    </div>
</div>
    

@stop

@section('css')
@stop

@section('js')

@stop
