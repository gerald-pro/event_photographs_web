<div>
    <div class="container pt-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Lista de fotografos</h4>
                <button type="button" class="btn btn-sm btn-primary ml-3" data-toggle="modal"
                    data-target="#inviteModal">Invitar</button>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($event->photographers as $item)
                            <tr>
                                <td scope="row">{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->invitationAceptedPhotographer($event) ? 'En el evento' : 'Aun no esta en el evento' }}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="card-footer text-muted">

            </div>
        </div>
    </div>



    <x-modal id="inviteModal" title="Nueva invitación">
        <x-slot name="body">
            <form id="invitationForm">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="addon-wrapping">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div wire:ignore style="width: 80%;">
                        <select wire:model='photographer' class="form-control select2 photographerSelect"
                            id="photographerSelect" style="width: 100%;" required>
                            <option></option>
                            @foreach ($allUsers as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" wire:click='send' id="sendButton"
                            wire:loading.attr="disabled">Enviar</button>
                    </div>
                </div>
                @error('photographer')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
            </form>
            <div class="row">
                <div class="table-responsive p-0" style="height: 500px;">
                    <table class="table table-head-fixed">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invitations as $item)
                                <tr>
                                    <td scope="row">{{ $item->name }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>
                                        @if ($item->status == 0)
                                            <span class="badge badge-pill badge-secondary">enviado</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">rechazado</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </x-slot>
    </x-modal>
</div>

@push('js')
    <script src="{{ asset('js/crud_resources.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.photographerSelect').select2({
                dropdownParent: $('#inviteModal'),
                languaje: 'es',
                theme: 'bootstrap4',
                placeholder: 'ingrese el nombre o correo',
                allowClear: true,
            });

            $('#photographerSelect').on('change', function(e) {
                var data = $('#photographerSelect').select2("val");
                console.log(data)
                @this.set('photographer', this.value);
            });

        });
    </script>
@endpush
