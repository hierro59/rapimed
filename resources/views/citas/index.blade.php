@extends('layouts.app')
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="form-head d-flex mb-sm-4 mb-3">
            <div class="mr-auto">
                <h2 class="text-black font-w600">Citas</h2>
                <p class="mb-0">Listado de citas</p>
            </div>
            <div>
                @can('customer-view')
                <a href="javascript:void(0)" class="btn btn-primary mr-3" data-toggle="modal" data-target="#addOrderModal">+Nueva cita</a>
                @endcan
                {{-- <a href="index.html" class="btn btn-outline-primary"><i class="las la-calendar-plus scale5 mr-3"></i>Filter Date</a> --}}
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
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        </div>
        @include('layouts.dashboard.forms')
        <div class="row">
            <div class="col-12">
                <div class="table-responsive card-table"  style="min-height: 200px;">
                    <table id="example5" class="display dataTablesCard table-responsive-xl">
                    @can('super-admin')
                        @include('citas.sections.superadmin-allcitas')
                    @elsecan('customer-view')
                        @include('citas.sections.pacientes-allcitas')
                    @elsecan('specialist-view')
                        @include('citas.sections.especialistas-allcitas')
                    @elsecan('coordcitas-view')
                        @include('citas.sections.coord-allcitas')
                    @endcan
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
