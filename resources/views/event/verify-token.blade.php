@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <div class="container py-3 px-1">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Verificar invitado</h4>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-6">
                        <div class="row-md-6">
                            <div class="card info">
                                @if (isset($result) && $result)
                                    <strong>Invitacion de </strong> {{ $result->name }}
                                    <br>
                                    <img src="{{ $result->profilePhotos()->first()->profile_photo_path }}" alt="FotoPerfil"
                                        height="150px" width="130px">
                                    @php
                                        $user = $result;
                                    @endphp
                                    <form id="elementform" action="{{ route('event.confirm', compact('event', 'user')) }}"
                                        method="POST">
                                        <strong>¿Confirmar asistencia?</strong>
                                        <div class="row">
                                            <input type="submit" value="Confirmar asistencia" class="btn btn-secondary">
                                        </div>
                                        @csrf
                                        @method('POST')
                                    </form>
                                @else
                                    {{ $message }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="reader"></div>
                    </div>
                </div>
                <br>
                <form action="{{ route('verify.token', $event) }}" method="GET">
                    @csrf
                    @method('GET')
                    <div class="form-row py-3 px-0">
                        <div class="input-group mb-3">
                            <input name="token" id="QR" type="text" value="" class="form-control"
                                placeholder="Token de acceso" readonly>
                            <div class="input-group-append">
                                <input type="submit" class="btn btn-primary" value="verificar">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer text-muted">
                <a href="" class="btn btn-secondary">Atras</a>
            </div>
        </div>
    </div>

@stop

@section('css')
    <style>
        body #reader {}

        .info {
            padding: 10px;
        }
    </style>
@stop

@section('js')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        let code = "";
        const qrInput = document.getElementById('QR');

        function onScanSuccess(decodedText, decodedResult) {
            code = decodedText;
            qrInput.value = code;
        }

        function onScanFailure(error) {
            console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 20,
                qrbox: {
                    width: 320,
                    height: 320
                }
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@stop
