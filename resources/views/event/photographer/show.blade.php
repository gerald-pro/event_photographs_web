@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')

    <div class="container py-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $eventosID->name }}</h4>
            </div>
            <div class="card-body">
                <p class="card-text">Text</p>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fecha">Fecha:</label>
                            <p type="text" class="border rounded p-2">{{ $eventosID->start_date }}</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="hora">Hora:</label>
                            <p type="text" class="border rounded p-2">{{ $eventosID->start_time }}</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="tipos_fotografias">Tipos de fotografías:</label>

                        @if ($eventosID->privacity == '1')
                            <p type="text" class="border rounded p-2">Publicas</p>
                        @elseif($eventosID->privacity == '2')
                            <p type="text" class="border rounded p-2">Solamente invitados al evento</p>
                        @elseif($eventosID->privacity == '3')
                            <p type="text" class="border rounded p-2">Solamente fotos personales</p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <p type="text" class="border rounded p-2">{{ $eventosID->detail }}</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="direccion">Dirección:</label>
                            <p type="text" class="border rounded p-2">{{ $eventosID->address }}</p>
                        </div>
                    </div>
                    <div style="border" class="col-md-4">
                        <div class="form-group">
                            <label for="direccion">Código de acceso:</label>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-expanded="false">
                                    QR
                                </button>
                                <div class="dropdown-menu p-3">
                                    <div id="qrcode"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer text-muted">
                <div class="row justify-content-between">
                    <button type="button" class="btn btn-secondary"
                        onclick="window.location='{{ route('events.listEvents.photographer') }}'">Atrás</button>
                    <br>
                    <button type="button" class="btn btn-success"
                        onclick="window.location='{{ route('event.gallery.index', $eventosID) }}'">Ver
                        galeria</button>
                </div>
            </div>
        </div>
    </div>







@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script>
        var qrcode = new QRCode("qrcode", {
            text: "{{ $token }}",
            width: 250,
            height: 250,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
        /*   const imageFin = qrcode._oDrawing._elImage;
           imageFin.addEventListener("load", function() {
               document.getElementById('qrimage').src = imageFin.src;
               const ref = document.getElementById('reference')
                ref.href = imageFin.src;
                ref.download = "QRinvitation.png";
           });*/

        $("#text").
        on("blur", function() {
            makeCode();
        }).
        on("keydown", function(e) {
            if (e.keyCode == 13) {
                makeCode();
            }
        });
    </script>
@stop
