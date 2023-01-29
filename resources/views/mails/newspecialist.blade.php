<h1>Hola <i>{{ $data->receiver }}</i>,</h1>
<h3>Has sido registrado en RapiMed como especialista</h3>

<p>Para gestionar su cuenta, debe ingrasar desde este enlace:</p>

<a href="https://rapimed.online/login" target="_BLANK">rapimed.online/login</a>
<br/>
<b>Usuario:</b> {{ $data->email }}
<br/>
<b>Password:</b> {{ $data->pass }}
<br/>
<br/>
Gracias por formar parte de nuestra familia,
<br/>
<b><i>{{ $data->sender }}</i></b>
