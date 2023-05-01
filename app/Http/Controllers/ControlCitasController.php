<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citas;
use App\Models\Specialist;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class ControlCitasController extends Controller
{
    public function DetalleCita($cita_id) {

        $id = Auth::user()->id;
        $notificaciones = Notification::where('to_id', $id)->get();
        $getCita = Citas::find($cita_id);
        $especialsta = Specialist::find($getCita->specialist_id);

        $datosCita = [
            'especialista' => $especialsta->degree . '-' . $especialsta->name,
            'cita_id' => $cita_id
        ];

        $getEspecialista = Specialist::find($getCita->specialist_id);

        return view('citas.consultorio-virtual', compact('datosCita', 'notificaciones', 'id'));
    }
    public function EditarCita(request $request) {
        $this->validate($request, [
            'specialist_id' => 'required',
            'cita_id' => 'required',
            'paciente_id' => 'required'
        ]);

        

    }
}
