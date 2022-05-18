@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card shadow mb-4" id="divTabla">
                    <div class="card-body py-3">
                        <div>
                            <div class="row">
                                <div class="col">
                                    <h6 class="m-0 font-weight-bold text-primary">Usuarios</h6>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#modalCreateUser"><i class="fas fa-user-plus"></i> Agregar nuevo Usuario</button>
                                </div>
                            </div>
                            <div >
                                <br>
                                <table id="tablaUsuarios" class="table display responsive nowrap" style="width:100%; overflow-x: auto;">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th >#</th>
                                            <th >Nombre</th>
                                            <th >Rol</th>
                                            <th >Email</th>
                                            <th >Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody style="color:black"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<!-- Modal -->
<div class="modal fade" id="modalCreateUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title m-0 font-weight-bold text-primary" id="staticBackdropLabel">Crear usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="contenidoModalEdicion">
                    <div class="card-body py-3">
                        <form class="was-validated" id="formularioepsEditar" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="Editar">Nombre</label><br>
                                <input id="name" name="name" type="text" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="Editar">Correo</label><br>
                                <input id="email" name="email" type="text" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="Editar">Contraseña</label><br>
                                <input id="password" name="password" type="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="Editar">Rol</label><br>
                                <select name="role" id="role" class="custom-select" required>
                                    <option value="">Seleccione</option>
                                    <option value="Administrator">Administrador</option>
                                    <option value="Cliente">Cliente</option>
                                </select>
                            </div>
                        </form>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary limpiarErrores" data-dismiss="modal" >Cerrar</button>
                <button type="button" class="btn btn-primary" id="saveUser">Guardar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title m-0 font-weight-bold text-primary" id="staticBackdropLabel">Editar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="contenidoModalEdicion">
                    <div class="card-body py-3">
                        <form class="was-validated" id="formularioepsEditar">
                            <input type="text" name="idUser" id="idUser" hidden>
                            <div class="mb-3">
                                <label for="Editar">Nombre</label><br>
                                <input id="nameEdit" name="nameEdit" type="text" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="Editar">Correo</label><br>
                                <input id="emailEdit" name="emailEdit" type="text" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="Editar">Rol</label><br>
                                <select name="roleEdit" id="roleEdit" class="custom-select" required>
                                    <option value="">Seleccione</option>
                                    <option value="Administrator">Administrador</option>
                                    <option value="Cliente">Cliente</option>
                                </select>
                            </div>
                            <select name="roleActualEdit" id="roleActualEdit" class="custom-select" required hidden>
                                <option value="">Seleccione</option>
                                <option value="Administrator">Administrador</option>
                                <option value="Cliente">Cliente</option>
                            </select>
                        </form>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary limpiarErrores" data-dismiss="modal" >Cerrar</button>
                <button type="button" class="btn btn-primary" id="saveEditUser">Guardar</button>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('js/users.js')}}"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" defer></script>
@endsection