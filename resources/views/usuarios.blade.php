@extends('adminlte::page')

@section('title', 'Usuarios')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
@section('content_header')
    <div class="tex-center">
        <h2><b>Usuarios</b></h2>
    </div>
@stop

@section('content')
<button class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#registrar">Añadir Usuario</button>
<table class="table table-striped table-bordered table-hover">
    <thead class="bg-danger text-white text-center">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">DOCUMENTO</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">APELLIDO</th>
            <th scope="col">CELULAR</th>
            <th scope="col">E-MAIL</th>
            <th scope="col">ROL</th>
            <th scope="col">SALARIO</th>
            <th scope="col">EDITAR</th>
            <th scope="col">ELIMINAR</th>

        </tr>
    </thead>
    <tbody class="table-group-divider text-center">
        @foreach ($users as $usuarios )
        <tr>
            <th scope="row">{{$usuarios->id}}</th>
            <td>{{$usuarios->documento}}</td>
            <td>{{$usuarios->nombre}}</td>
            <td>{{$usuarios->apellido}}</td>
            <td>{{$usuarios->celular}}</td>
            <td>{{$usuarios->email}}</td>
            <td>{{$usuarios->rol}}</td>
            <td>{{$usuarios->salario}}</td>
            <td><a href="" data-bs-toggle="modal" data-bs-target="#editar{{$usuarios->id}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
            <td><a href="" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a></td>
            <!-- Modal modificar datos -->
            <!-- <div class="modal fade" id="editar{{$usuarios->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre"  value="{{$usuarios->nombre}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Apellido</label>
                                    <input type="text" class="form-control" name="apellido" value="{{$usuarios->apellido}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Documento</label>
                                    <input type="text" class="form-control" name="documento" value="{{$usuarios->documento}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Correo</label>
                                    <input type="email" class="form-control" name="correo" value="{{$usuarios->correo}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Celular</label>
                                    <input type="text" class="form-control" name="celular" value="{{$usuarios->celular}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Edad</label>
                                    <input type="text" class="form-control" name="edad" value="{{$usuarios->edad}}" required>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div> -->
        </tr>
        @endforeach
    </tbody>
</table>
<div class="modal fade" id="registrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Usuario</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                <form action="{{ route('usuarios.insertar') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Documento</label>
                                <input type="text" class="form-control" name="documento" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Apellido</label>
                                <input type="text" class="form-control" name="apellido" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Celular</label>
                                <input type="text" class="form-control" name="celular" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">E-mail</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Rol</label>
                                <select class="form-select" name="rol" aria-label="Default select example">
                                    <option selected>Seleciona el rol</option>
                                    <option value="Mantenimiento">Mantenimiento</option>
                                    <option value="Aseadora">Aseadora</option>
                                    <option value="Conductor">Conductor</option>
                                    <option value="Gerente">Gerente</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Salario</label>
                                <input type="text" class="form-control" name="salario" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="contraseña" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <!-- <script>
        Swal.fire({
            title: 'Estas seguro?',
            text: "No podras revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Enviar'
        }).then((result) => {
            if (result.isConfirmed) {
                    Swal.fire(
                    '¡Registrado!',
                    'El usuario ha sido insertado correctamente',
                    'success'
                    )
            }
        })
    </script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
@stop
