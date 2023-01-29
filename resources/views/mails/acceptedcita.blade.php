<h1>Hola <i>{{ $data->receiver }}</i>,</h1>
<h3>Solicitud de consulta Aceptada</h3>

<ul>
    <li>Paciente: {{ $data->receiver }}</li>
    <li>Fecha: {{ $data->fecha }}</li>
    <li>Hora: {{ $data->hora }}</li>
    <li>Tipo: {{ $data->tipo }}</li>
</ul>

<p>Recuerde ingresar al sistema para contarnos su experiancia.</p>

<p>Su opinion es muy importante para nosotros.</p>

<a href="https://rapimed.online/login" target="_BLANK">rapimed.online/login</a>
<br/>
<br/>
Gracias por formar parte de nuestra familia,
<br/>
<b><i>{{ $data->sender }}</i></b>
