@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <div class="container pt-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Eventos creados</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive table-sm">
                    <table class="table caption-top">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <p hidden>{{ $counter = 1 }}</p>
                            @foreach ($eventos as $evento)
                                <tr>
                                    <td>{{ $evento->name }}</td>
                                    <td>
                                        <a href="{{ route('event.edit', $evento->id) }}" class="btn btn-light"><i
                                                class="fa fa-pen"></i></a>
                                        <a href="{{ route('event.show', $evento->id) }}" class="btn btn-light"><i
                                                class="fa fa-eye"></i></a>
                                        <a href="{{ route('verify.token', $evento->id) }}" class="btn btn-light"><i
                                                class="fas fa-list-alt"></i></a>
                                        <form action="{{ route('event.destroy', $evento->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-light"
                                                onclick="return confirm('¿Estas Seguro de Eliminarlo?')"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-muted">
                Footer
            </div>
        </div>
    </div>
@stop
