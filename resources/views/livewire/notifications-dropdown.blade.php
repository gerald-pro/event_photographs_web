<div>

    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
            <i class="far fa-bell"></i>
            @if (auth()->user()->hasRole(['Fotografo']) && $invitations->count() > 0)
                <span class="badge badge-warning navbar-badge">{{ $invitations->count() }}</span>
            @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
            <span class="dropdown-item dropdown-header">{{ $invitations->count() }} Notificationes</span>
            <div class="dropdown-divider"></div>
            @if (auth()->user()->hasRole(['Fotografo']))
                <div class="col px-3 py-2">

                    @foreach ($invitations as $item)
                        <div class="row">
                            <div class="dropdown-divider"></div>
                            <div class="col">
                                <div class="row">
                                    <a href="{{ route('event.show', $item) }}">Nueva
                                        invitacion a evento:
                                        {{ $item->name }}</a>
                                    <span
                                        class="float-right text-muted text-sm text-right">{{ $item->pivot->updated_at->format('d/m/y h:m') }}</span>
                                </div>
                                <div class="row">
                                    <button type="button" class="btn btn-primary" btn-block"
                                        wire:click='reply({{ $item->id }}, 0)'>rechazar</button>
                                    <button type="button" class="btn btn-primary" btn-block"
                                        wire:click='reply({{ $item->id }}, 1)'>Aceptar</button>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            @endif
            {{-- <a href="#" class="dropdown-item dropdown-footer">Ver todas las notificaciones</a> --}}
        </div>
    </li>

</div>
