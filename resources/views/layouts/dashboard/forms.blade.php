<!--**********************************
    Nueva Cita start
***********************************-->
<div class="modal fade" id="addOrderModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Solicitar cita</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(array('route' => 'citas.store','method'=>'POST')) !!}
                    <div class="form-group">
                        <label class="text-black font-w500">Especialidad</label>
                        @php
                            $line = [];
                            foreach ($specialist as $key => $value) {
                                $line[$value->id] = $value->specialty . " | " . $value->degree . " " . $value->name;
                                array_push($line);
                            }
                        @endphp
                        {!! Form::select('specialist_id', $line,[], array('placeholder' => 'Seleccione un especialista','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Fecha de cita</label>
                        {!! Form::date('fecha_cita', null, array('placeholder' => 'Fecha de la cita','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Hora de cita</label>
                        {!! Form::time('hora_cita', null, array('placeholder' => 'Hora de la cita','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Tipo de cita</label>
                        @php
                            $optionsTipo = [
                                'Domicilio' => 'En mi casa',
                                'Consultorio' => 'En el consultorio',
                                'Virtual' => 'Virtual'
                            ];
                        @endphp
                        {!! Form::select('tipo', $optionsTipo,[], array('placeholder' => 'Seleccione el tipo de cita','class' => 'form-control','simple')) !!}
                    </div>

                    {!! Form::text('user_id', $id, array('hidden')) !!}
                    <small>Le notificaremos cuando le sea asignado un especialista y sea aceptada su solicitud.</small>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Solicitar</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!--**********************************
    Nueva Cita end
***********************************-->
