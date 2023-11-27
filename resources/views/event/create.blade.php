@extends('adminlte::page')

@section('title', 'Crear Evento')

@section('content')
    <div class="container pt-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Crear Evento</h4>
            </div>
            <form action="{{ route('event.store') }}" method="POST" id="formulario">
                @method('post')
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                placeholder="Nombre del evento" required>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="fecha">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" placeholder="fecha"
                                required>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="hora">Hora</label>
                            <input type="time" class="form-control" id="hora" name="hora" placeholder="fecha"
                                required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="descripcion">Descripcion</label>
                            <textarea class="form-control" id="descripcion" name="descripcion">
                            </textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="direccion">Direccion</label>
                            <input type="text" class="form-control" id="direccion" name="direccion"
                                placeholder="Direccion del evento" required>
                        </div>
                    </div>

                    <div class="form-group col-md-10 photo">
                        <label>Tipos de fotografias permitidas en el evento</label>
                        <select class="form-control select2" name="tipos_fotografias" id="tipos_fotografias"
                            style="width: 100%;">
                            <option value="{{ null }}">Elija una opcion</option>
                            <option value="0">Publicas</option>
                            <option value="1">Solo invitados al evento</option>
                            <option value="2">Solo fotos personales</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-row">
                        <div class="form-group col-md-12 text-right">
                            <a href="{{ route('event.index') }}" class="btn btn-secondary">Atrás</a>
                            <button type="submit" class="btn btn-info">Crear</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
