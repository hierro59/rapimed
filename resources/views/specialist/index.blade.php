@extends('layouts.app')
@section('content')
    <div class="content-body">
        <div class="row" style="padding: 2%">
            <div class="col-sm-6 pull-left">
                <h2>Specialist Management</h2>
            </div>
            <div class="col-sm-6 d-md-flex justify-content-md-end">
                <a class="btn btn-success" href="{{ route('specialist.create') }}"> Create New Specialist</a>
            </div>
        </div>

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Specialty</th>
                <th>Status</th>
                <th width="280px">Action</th>
            </tr>

        @foreach ($data as $key => $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->specialty }}</td>
                <td>
                    @switch($user->status)
                        @case(1)
                        <span class="btn btn-success text-nowrap btn-sm">Activo</span>
                            @break

                        @case(2)
                        <span class="btn btn-warning text-nowrap btn-sm">Suspendido</span>
                            @break

                        @case(3)
                        <span class="btn btn-danger text-nowrap btn-sm">Bloqueado</span>
                            @break

                        @default
                        <span class="btn btn-warning text-nowrap btn-sm light">Desconocido</span>
                    @endswitch

                </td>
                <td>
                    <?php
                        foreach ($ide as $key => $value) {
                            if ($value->email == $user->email) {
                                $ideSpe = $value->id;
                            }
                        }
                    ?>
                    <a class="btn btn-info" href="{{ route('users.show',$ideSpe) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('specialist.edit',$ideSpe) }}">Edit</a>
                        {!! Form::open(['method' => 'DELETE','route' => ['specialist.destroy', $ideSpe],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </table>
        {!! $data->render() !!}
    </div>
@endsection

