<div>
    Hola, Espero que te encuentres bien. <br>
    Queríamos invitarte al evento llamado {{ $mailData['event_name'] }}. <br><br>
    Detalles del evento: <br>
    Fecha y hora: {{ $mailData['start_date'] }} - {{ $mailData['start_time'] }} <br>
    Lugar: {{ $mailData['address'] }} <br><br>
    Esperamos contar con tu presencia. Para confirmar tu asistencia, por favor haz clic en
    el siguiente enlace: <br><br>

    @php
        $qrContent = 'https://tu-url-o-datos-a-codificar';
        $png = QrCode::format('png')
            ->size(300)
            ->generate($qrContent);
    @endphp

    <img src="data:image/png;base64,{{ base64_encode($png) }}" alt="Código QR">
    Saludos <br>
    {{ $mailData['sender_name'] }}
</div>
