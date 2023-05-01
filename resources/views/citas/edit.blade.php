@extends('layouts.app')
@section('content')
<div class="content-body">
           
    {!! Form::open(array("route" => ["citas.update", $cita->id] , "method"=>"PATCH")) !!}
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6">
                Especialista: 
                <h4>{{ $especialista->degree . " " . $especialista->name }}</h4>
                <small>{{ $especialista->specialty  }}</small>
            </div>
            <div class="col-sm-6">
                Paciente: 
                <h4>{{ $paciente->name }}</h4>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="text-black font-w500">Fecha de cita</label>
        @php
            $fecha = explode(" ", $cita->fecha_cita);
        @endphp
        {!! Form::date("fecha_cita", $fecha[0], array("class" => "form-control")) !!}
    </div>
    <div class="form-group">
        <label class="text-black font-w500">Hora de cita</label>
        {!! Form::time("hora_cita", $cita->hora_cita, array("class" => "form-control")) !!}
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
        {!! Form::select("tipo", $optionsTipo, $cita->tipo, array("class" => "form-control","simple")) !!}
    </div>
    <input type="text" name="cita" value="{{$cita->id}}" hidden>
    <input type="text" name="id" value="{{$cita->id}}" hidden>
    <input type="text" name="status" value="{{$cita->status}}" hidden>
    <input type="text" name="accion" value="reprogramar" hidden>
    <input type="text" name="especialista" value="{{ $especialista->degree . " " . $especialista->name }}" hidden>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
    {!! Form::close() !!}
</div>
        
@endsection