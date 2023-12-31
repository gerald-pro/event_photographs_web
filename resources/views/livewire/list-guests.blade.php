<div>
    <div class="container pt-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Lista de invitados</h4>
                <button type="button" class="btn btn-sm btn-primary ml-3" data-toggle="modal"
                    data-target="#inviteModal">Invitar</button>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($event->guests as $item)
                            <tr>
                                <td scope="row">{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
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
                        <span class="input-group-text" id="addon-wrapping">@</span>
                    </div>
                    <input wire:model='emailReceiver' class="form-control" placeholder="email" type="email"
                        id="emailReceiver" required>
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" wire:click='send' id="sendButton"
                            wire:loading.attr="disabled">Enviar</button>
                    </div>
                </div>
                @error('emailReceiver')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
            </form>
            <div class="table-responsive p-0" style="height: 550px;">
                <table class="table table-head-fixed">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invitations as $item)
                            <tr>
                                <td scope="row">{{ $item->email_receiver }}</td>
                                <td>{{ $item->send_date }}</td>
                                <td>
                                    @switch($item->status)
                                        @case(0)
                                            <span class="badge badge-pill badge-secondary">enviado</span>
                                        @break

                                        @case(1)
                                            <span class="badge badge-pill badge-success">aceptado</span>
                                        @break

                                        @case(2)
                                            <span class="badge badge-pill badge-danger">rechazado</span>
                                        @break

                                        @default
                                    @endswitch

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-slot>
    </x-modal>
</div>

@push('js')
    <script src="{{ asset('js/crud_resources.js') }}"></script>
@endpush
