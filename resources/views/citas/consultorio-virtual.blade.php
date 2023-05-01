@extends('layouts.app')
@section('content')
<script src="https://meet.jit.si/external_api.js"></script>
<div class="content-body">
    <div class="form-head d-flex align-items-center mb-sm-4 mb-3">
        <div class="mr-auto">
            <h2 class="text-black font-w600"><i class="fa-solid fa-users-viewfinder"></i> Consultorio Virtual</h2>
            <p class="mb-0">RapiMed</p>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-9">
                <div id="meet" style="width: 100%; height: 400px;"></div>
            </div>
            <div class="col-sm-3">
                <form action="{{ route('scorecustomer.store') }}" method="POST">
                    <div class="form-group">
                        <h3 class="text-black font-w500">Calificar</h3>
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">¿Cuantos <i class="fa-solid fa-heart" style="color: red"></i> le das?</label>
                        <select class="form-control" name="score" id="">
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                            <option value="0">0</option>
                            <option value="-1">-1</option>
                            <option value="-2">-2</option>
                            <option value="-3">-3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="commit" id="" cols="30" rows="10" placeholder="Escriba aquí una breve opinión sobre su experiencia"></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Calificar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var domain = "meet.jit.si";
    var options = {
        roomName: "Cita-Rapimed-{{ $datosCita['especialista'] . '-' . $datosCita['cita_id'] }}",
        parentNode: document.querySelector('#meet'),
        lang: 'es',
        configOverwrite: {},
        interfaceConfigOverwrite: {}
    }
    var api = new JitsiMeetExternalAPI(domain, options);
</script>
@endsection