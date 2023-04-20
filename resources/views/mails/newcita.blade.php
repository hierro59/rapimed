<h1>Hola <i>{{ $data->degree }} {{ $data->receiver }}</i>,</h1>
<h3>Nueva solicitud de consulta</h3>

<ul>
    <li>Paciente: {{ $data->paciente }}</li>
    <li>Fecha: {{ $data->fecha }}</li>
    <li>Hora: {{ $data->hora }}</li>
    <li>Tipo: {{ $data->tipo }}</li>
</ul>

<p>Recuerde ingresar al sistema y gestionar sus citas. Los pacientes esperan pronta respuesta de usted.</p>

<a href="https://rapimed.site/login" target="_BLANK">rapimed.site/login</a>
<br/>
<br/>
Gracias por formar parte de nuestra familia,
<br/>
<b><i>{{ $data->sender }}</i></b>
