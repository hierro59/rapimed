<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\CitasController;

class MailController extends Controller
{
    public function send(Request $request)
    {
        (isset($request->nombre) ? $nombre = $request->nombre : $nombre = "Sin nombre");
        (isset($request->email) ? $email = $request->email : $email = "Sin email");
        (isset($request->especialidad) ? $especialidad = $request->especialidad : $especialidad = "Sin especialidad");
        (isset($request->telefono) ? $telefono = $request->telefono : $telefono = "Sin telefono");
        (isset($request->mensaje) ? $mensaje = $request->mensaje : $mensaje = "Sin mensaje");
        (isset($request->fecha_cita) ? $fecha = $request->fecha_cita : $fecha = "Sin fecha");
        (isset($request->destino) ? $destino = $request->destino : $destino = "hierro59@gmail.com");
        (isset($request->tipo) ? $tipo = $request->tipo : $tipo = "Sin tipo");
        (isset($request->ciudad) ? $ciudad = $request->ciudad : $ciudad = "Sin ciudad");

        if (isset($request->specialist_id)) {
            $nueva = new CitasController;
            $nueva->store($request);
        }
        
        $objDemo = new \stdClass();
        $objDemo->nombre = $nombre;
        $objDemo->email = $email;
        $objDemo->especialidad = $especialidad;
        $objDemo->telefono = $telefono;
        $objDemo->fecha = $fecha;
        $objDemo->mensaje = $mensaje;
        $objDemo->tipo = $tipo;
        $objDemo->ciudad = $ciudad;
        $objDemo->sender = 'RapiMed';
        Mail::to($destino)->send(new DemoEmail($objDemo));
        return back();
        //dd("Email is sent successfully.");
    }
}