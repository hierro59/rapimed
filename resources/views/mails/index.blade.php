<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Rapimed | Nueva cita</title>
</head>
<body>
    @php
        //var_dump($mailData);
    @endphp
    <h1>{{-- {{ $mailData['title'] }} --}}</h1>
    <p>Hola! Te han solicitado una nueva cita.</p>
    <p>{{-- {{ $mailData['body'] }} --}}</p>
</body>
</html>
