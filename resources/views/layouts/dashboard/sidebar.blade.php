<!--**********************************
    Sidebar start
***********************************-->
<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li><a href="{{ url('/home') }}" aria-expanded="false">
                    <i class="flaticon-381-home"></i>
                    <span class="nav-text">Inicio</span>
                </a>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-notepad"></i>
                    <span class="nav-text">Citas</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="javascript:void(0)" data-toggle="modal" data-target="#addOrderModal">Nueva cita</a></li>
                    <li><a href="{{ route('citas.index') }}">Mis citas</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-location-1"></i>
                    <span class="nav-text">Servicios</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="#">Medicinas <span class="badge light text-white bg-secondary">Pronto</span></a></li>
                    <li><a href="#">Laboratorios <span class="badge light text-white bg-secondary">Pronto</span></a></li>
                    <li><a href="#">Traslados <span class="badge light text-white bg-secondary">Pronto</span></a></li>
                </ul>
            </li>
            <li><a href="{{ route('users.show', Auth::user()->id) }}" aria-expanded="false">
                    <i class="flaticon-381-user-7"></i>
                    <span class="nav-text">Mi Perfil</span>
                </a>
            </li>
            <li><a href="{{ route('specialist.show', Auth::user()->id) }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-heart"></i>
                    <span class="nav-text">Mis Especialistas</span>
                </a>
            </li>
        @can('super-admin')
        <hr style="width: 80%">
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-settings-2"></i>
                    <span class="nav-text">Administrar</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Usuarios</a>
                        <ul aria-expanded="false">
                            <li style="background-color: #eee; margin-left: 5%"><a href="{{ url('/users') }}">Listado</a></li>
                            <li style="background-color: #eee; margin-left: 5%"><a href="{{ url('/users/create') }}">Crear</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Especialistas</a>
                        <ul aria-expanded="false">
                            <li style="background-color: #eee; margin-left: 5%"><a href="{{ route('specialist.create') }}">Nuevo</a></li>
                            <li style="background-color: #eee; margin-left: 5%"><a href="{{ route('specialist.store') }}">Listado</a></li>
                        </ul>
                    </li>
                    @can('super-admin')
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Roles</a>
                        <ul aria-expanded="false">
                            <li style="background-color: #eee; margin-left: 5%"><a href="{{ url('/roles') }}">Listado</a></li>
                            <li style="background-color: #eee; margin-left: 5%"><a href="{{ url('/roles/create') }}">Crear</a></li>
                        </ul>
                    </li>
                    @endcan
                </ul>
            </li>
        @endcan
        </ul>
        <div class="copyright">
            <p><strong>RapiMed</strong> © 2023 All Rights Reserved</p>
            <p>Made with ♥ by <a style="text-decoration: none" href="https://quantlas.tech" target="_BLANK">Quantlas</a></p>
        </div>
    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->
