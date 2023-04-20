@extends('layouts.app')
@section('content')
    <div class="content-body">
        <div class="row" style="padding: 2%">
            <div class="col-sm-6 pull-left">
                <h2>Create New Specialist</h2>
            </div>
            <div class="col-sm-6 d-md-flex justify-content-md-end">
                <a class="btn btn-primary" href="{{ route('specialist.index') }}"> Back</a>
            </div>
        </div>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::open(array('route' => 'specialist.store','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}
        <div class="row" style="padding: 5%">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Degree:</strong>
                    {!! Form::text('degree', null, array('placeholder' => 'Degree','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Specialty:</strong>
                    {!! Form::text('specialty', null, array('placeholder' => 'Specialty','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Bio:</strong>
                    {!! Form::textarea('bio', null, array('placeholder' => 'Bio','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Consulta a domicilio:</strong>
                    {!! Form::select('tipo_consulta', ['Domicilio' => 'Domicilio', 'Virtual' => 'Virtual', 'Consultorio' => 'Consultorio'],[], array('class' => 'form-control','multiple')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {{-- <input type="checkbox" class="btn-check" id="btn-check-2-outlined" checked autocomplete="off"> --}}
                    <br>
                    <strong>Tipo de consulta:</strong><br>
                    <span class="p-4">
                        {!! Form::checkbox('tc_domicilio', 1, 'Domicilio', array('class' => 'btn-check', 'id' => 'btn-check-1-outlined', 'autocomplete' => 'off')) !!}
                        <label class="btn btn-outline-secondary" for="btn-check-1-outlined">Domicilio</label>
                    </span>
                    <span class="p-4">
                        {!! Form::checkbox('tc_virtual', 1, 'Virtual', array('class' => 'btn-check', 'id' => 'btn-check-2-outlined', 'autocomplete' => 'off')) !!}
                        <label class="btn btn-outline-secondary" for="btn-check-2-outlined">Virtual</label>
                    </span>
                    <span class="p-4">
                        {!! Form::checkbox('tc_consultorio', 1, 'Consultorio', array('class' => 'btn-check', 'id' => 'btn-check-3-outlined', 'autocomplete' => 'off')) !!}
                        <label class="btn btn-outline-secondary" for="btn-check-3-outlined">Consultorio</label>
                    </span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Fecha de nacimiento:</strong>
                    {!! Form::date('dob', null, array('placeholder' => 'Fecha de nacimiento','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Fecha de grado:</strong>
                    {!! Form::date('dog', null, array('placeholder' => 'Fecha de grado','class' => 'form-control')) !!}
                </div>
            </div>
            
            {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Photo: </strong>
                    {!! Form::file('photo', null, array('class' => 'form-control')) !!}
                </div>
            </div> --}}
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Password:</strong>
                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Confirm Password:</strong>
                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                </div>
            </div>
            {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Role:</strong>
                    {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                </div>
            </div> --}}
            {!! Form::text('roles', 'Especialista', array('hidden')) !!}
            <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top: 2%">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
