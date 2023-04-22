<!--**********************************
    FORMULARIO GUARDAR SEXO
***********************************-->
<div class="modal fade" id="upSex">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Seleccione su sexo</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                <form action="{{route('users.update', Auth::user()->id)}}" method="PATCH">
                    @csrf
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @php
                        $optionsTipo = [
                            '1' => 'Masculino',
                            '2' => 'Femenino',
                            '0' => 'Otro'
                        ];
                    @endphp
                    {{Form::select('sexo', $optionsTipo,[], array('placeholder' => 'Escoja su sexo', 'class' => 'custom-select'))}}

                        {{-- <select name="sexo" id="" >
                            <option value="1" >Masculino</option>
                            <option value="2">Femenino</option>
                        </select> --}}
                        {{-- <input type="file" name="file" class="custom-file-input" id="chooseFile">
                        <label class="custom-file-label" for="chooseFile">Seleccione imagen</label> --}}

                    <button type="submit" name="submit" class="btn btn-outline-danger btn-block mt-4">
                        Guardar
                    </button>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!--**********************************
    FORMULARIO GUARDAR SEXO end
***********************************-->
<!--**********************************
    FORMULARIO GUARDAR medical_history
***********************************-->

<div class="modal fade" id="upHistorial">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Historial Médico</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                <form action="{{route('users.update', Auth::user()->id)}}" method="PATCH">
                    @csrf
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {!! Form::textarea('historial', $data['historial'], array('placeholder' => $data['historial'],'class' => 'form-control')) !!}

                    <button type="submit" name="submit" class="btn btn-outline-danger btn-block mt-4">
                        Guardar
                    </button>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<!--**********************************
    FORMULARIO GUARDAR medical_history end
***********************************-->
<!--**********************************
    FORMULARIO GUARDAR bio
***********************************-->
@if (Auth::user()->id == $id)
<div class="modal fade" id="upBio">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Biografía</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                <form action="{{route('users.update', Auth::user()->id)}}" method="PATCH">
                    @csrf
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {!! Form::textarea('bio', $data['bio'], array('placeholder' => $data['bio'],'class' => 'form-control')) !!}

                    <button type="submit" name="submit" class="btn btn-outline-danger btn-block mt-4">
                        Guardar
                    </button>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endif
<!--**********************************
    FORMULARIO GUARDAR bio end
***********************************-->
<!--**********************************
    FORMULARIO GUARDAR direccion
***********************************-->
<div class="modal fade" id="upDireccion">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dirección personal</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                <form action="{{route('users.update', Auth::user()->id)}}" method="PATCH">
                    @csrf
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <strong class="label">Dirección:</strong>
                    {!! Form::text('address', $data['direccion'], array('placeholder' => 'Dirección','class' => 'form-control')) !!}
                    <strong class="label">Ciudad/Municipio:</strong>
                    {!! Form::text('ciudad', $data['ciudad'], array('placeholder' => 'Ciudad/Municipio','class' => 'form-control')) !!}
                    <strong class="label">Estado/Provincia:</strong>
                    {!! Form::text('estado', $data['estado'], array('placeholder' => 'Estado/Provincia','class' => 'form-control')) !!}
                    {!! Form::text('pais', 'VE', array('placeholder' => 'Pais','class' => 'form-control', 'hidden')) !!}

                    <button type="submit" name="submit" class="btn btn-outline-danger btn-block mt-4">
                        Guardar
                    </button>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!--**********************************
    FORMULARIO GUARDAR direccion end
***********************************-->
<!--**********************************
    FORMULARIO GUARDAR Teléfono
***********************************-->
<div class="modal fade" id="upPhone">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Teléfono</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                <form action="{{route('users.update', Auth::user()->id)}}" method="PATCH">
                    @csrf
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <strong class="label">Teléfono:</strong>
                    {!! Form::text('phone', $data['phone'], array('placeholder' => 'Teléfono','class' => 'form-control')) !!}

                    <button type="submit" name="submit" class="btn btn-outline-danger btn-block mt-4">
                        Guardar
                    </button>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!--**********************************
    FORMULARIO GUARDAR Teléfono end
***********************************-->
