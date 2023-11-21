@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Galeria de imagenes</h1>
@stop

@section('content')
        <section class="gallery-block compact-gallery cards-gallery">
            <div class="container">
                <div class="row">
                    @foreach($pictures as $picture)
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 transform-on-hover">
                            <a class="lightbox" href="{{$picture->url}}">
                                <img src="{{$picture->url}}" alt="Card Image" class="card-img-top">
                            </a>
                            <div class="card-body">
                                <h6>
                                    <a href="#">{{$picture->name}}</a>
                                </h6>
                                <p class="text-muted card-text">{{$picture->created_at}} <br/><strong>Precio: </strong>{{$picture->price}}Bs.</p>
                                <div class="row">
                                    <form action="{{route('event.gallery.destroy',compact('event','picture'))}}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="submit" class="btn btn-danger" value="Eliminar">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
    </section>
@stop

@section('css')
    <link href="https://fonts.googleapis.com/css?family=Raleway:200,100,400" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" />
    <link rel="stylesheet" href="/css/compact-gallery.css">
@stop

@section('js')
  
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>

    <!-- local script file  -->
    <script>
        try {
			    document.addEventListener('DOMContentLoaded', function () {
        baguetteBox.run('.compact-gallery', { animation: 'slideIn' });
    });
		} catch (error) {
			console.error("Error relacionado con la pantalla completa:", error);
		}
    </script>
@stop
