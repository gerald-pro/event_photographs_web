@extends('adminlte::page')

@section('title', 'Editar Evento')

@section('content')
    <div class="container pt-4">
        <div class="card">
            <div class="card-header">
                Editar Evento
            </div>
            <form action="{{ route('event.update', $eventoId->id) }}" method="POST" id="formulario">
                {{ method_field('PUT') }}
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">

                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required
                                value="{{ $eventoId->name }}">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="fecha">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required
                                value="{{ $eventoId->start_date }}">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="hora">Hora</label>
                            <input type="time" class="form-control" id="hora" name="hora" required
                                value="{{ $eventoId->start_time }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="descripcion">Descripcion</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" required>
{{ $eventoId->detail }}
</textarea>

                        </div>

                        <div class="form-group col-md-6">
                            <label for="direccion">Direccion</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required
                                value="{{ $eventoId->address }}">
                        </div>
                    </div>

                    <div class="form-group col-md-10 photo">
                        <label>Tipos de fotografias permitidas en el evento {{ $eventoId->privacity }}</label>

                        <select class="form-control select2" name="tipos_fotografias" id="tipos_fotografias"
                            style="width: 100%;">
                            <option value="0" {{ $eventoId->privacity == 0 ? 'selected' : '' }}>Publicas</option>
                            <option value="1" {{ $eventoId->privacity == 1 ? 'selected' : '' }}>Solo invitados al
                                evento
                            </option>
                            <option value="2" {{ $eventoId->privacity == 2 ? 'selected' : '' }}>Solo fotos personales
                            </option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-row">
                        <div class="form-group col-md-12 text-right">
                            <a href="{{ route('event.index') }}" class="btn btn-secondary">Atrás</a>
                            <button type="submit" class="btn btn-info">Actualizar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
