<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citas;
use App\Models\Specialist;

class ControlCitasController extends Controller
{
    public function DetalleCita($cita_id) {
        
        $getCita = Citas::find($cita_id);

        $getEspecialista = Specialist::find($getCita->specialist_id);

        $response = '<div class="modal fade" id="sendMessageModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Solicitar una cita</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(array("route" => "citas.store","method"=>"POST")) !!}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-8">
                                Especialista: 
                                <h4>' . $getEspecialista->degree . ' . " " . ' . $getEspecialista->name . '</h4>
                                <small>' . $getEspecialista->specialty . '</small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Fecha de cita</label>
                        {!! Form::date("fecha_cita", null, array("value" => "' . $getCita->fecha_cita . '","class" => "form-control")) !!}
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Hora de cita</label>
                        {!! Form::time("hora_cita", null, array("value" => "' . $getCita->hora_cita . '","class" => "form-control")) !!}
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Tipo de cita</label>
                        @php
                            $optionsTipo = [
                                "Domicilio" => "En mi casa",
                                "Consultorio" => "En el consultorio",
                                "Virtual" => "Virtual"
                            ];
                        @endphp
                        {!! Form::select("tipo", $optionsTipo,[], array("placeholder" => "' . $getCita->tipo . '","class" => "form-control","simple")) !!}
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Solicitar</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>';

        return $response;
    }
    public function EditarCita(request $request) {
        $this->validate($request, [
            'specialist_id' => 'required',
            'cita_id' => 'required',
            'paciente_id' => 'required'
        ]);

        

    }
}
