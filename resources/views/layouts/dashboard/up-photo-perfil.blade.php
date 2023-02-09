<!--**********************************
    FORMULARIO SUBIR AVATAR
***********************************-->
<div class="modal fade" id="upPhotoPerfil">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto de perfil</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('resizeImage')}}" method="post" enctype="multipart/form-data">
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
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="chooseFile">
                        <label class="custom-file-label" for="chooseFile">Seleccione imagen</label>
                    </div>
                    <input type="text" name="type" value="avatar" hidden>
                    <button type="submit" name="submit" class="btn btn-outline-danger btn-block mt-4">
                        Guardar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--**********************************
    FORMULARIO SUBIR AVATAR end
***********************************-->
<!--**********************************
    FORMULARIO SUBIR PORTADA
***********************************-->
<div class="modal fade" id="upPhotoPortada">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto de portada</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('resizeImage')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="chooseFile">
                        <label class="custom-file-label" for="chooseFile">Seleccione imagen</label>
                    </div>
                    <input type="text" name="type" value="portada" hidden>
                    <button type="submit" name="submit" class="btn btn-outline-danger btn-block mt-4">
                        Guardar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--**********************************
    FORMULARIO SUBIR PORTADA end
***********************************-->
