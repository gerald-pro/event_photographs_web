@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <div class="container pt-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Evento: {{ $eventosID->name }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha">Nombre:</label>
                            <p type="text" class="border rounded p-2">{{ $eventosID->name }}</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="fecha">Fecha:</label>
                            <p type="text" class="border rounded p-2">{{ $eventosID->start_date }}</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="hora">Hora:</label>
                            <p type="text" class="border rounded p-2">{{ $eventosID->start_time }}</p>
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <p type="text" class="border rounded p-2">{{ $eventosID->detail }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="direccion">Dirección:</label>
                            <p type="text" class="border rounded p-2">{{ $eventosID->address }}</p>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="tipos_fotografias">Tipos de fotografías permitidas en el evento:</label>

                    @if ($eventosID->privacity == 0)
                        <p type="text" class="border rounded p-2">Publicas</p>
                    @elseif($eventosID->privacity == 1)
                        <p type="text" class="border rounded p-2">Solo invitados al evento</p>
                    @elseif($eventosID->privacity == 2)
                        <p type="text" class="border rounded p-2">Solo fotos personales</p>
                    @endif
                </div>

                <div class="text-right mb-3">
                    <a href="{{ route('events.guests', ['event' => $eventosID->id]) }}" class="btn btn-outline-secondary">
                        Invitados
                    </a>
                    <a href="{{ route('events.photographers', ['event' => $eventosID->id]) }}" class="btn btn-outline-secondary">
                        Fotógrafos
                    </a>
                </div>



            </div>
            <div class="card-footer">

                <a type="button" class="btn btn-secondary" href="{{ route('event.index') }}">Atrás</a>

            </div>
        </div>
    </div>
@stop
