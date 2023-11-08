<template>
    <div class="container" >
        <div>
            <h3 class="text-center"><b>AÑADIR USUARIO</b></h3>
            <form action="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Documento</label>
                            <input type="text" class="form-control" name="documento" v-model="registerUser.documento" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" v-model="registerUser.nombre" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Apellido</label>
                            <input type="text" class="form-control" name="apellido" v-model="registerUser.apellido" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Celular</label>
                            <input type="text" class="form-control" name="celular" v-model="registerUser.celular" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">E-MAIL</label>
                            <input type="text" class="form-control" name="email" v-model="registerUser.email" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">ROL</label>
                            <select class="form-select" aria-label="" name="rol" v-model="registerUser.rol">
                                <option selected>Seleciona..</option>
                                <option value="Aseadora">Aseadora</option>
                                <option value="Mantenimiento">Mantenimiento</option>
                                <option value="Gerente">Gerente</option>
                                <option value="Conductor">Conductor</option>
                            </select>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">SALARIO</label>
                            <input type="text" class="form-control" name="salario" v-model="registerUser.salario" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">CONTRASEÑA</label>
                            <input type="password" class="form-control" name="password" v-model="registerUser.password" required>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-success" type="button" @click="saveRegister() ">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    import Swal from 'sweetalert2'
    export default {
        data(){
            return{
                //crear arreglo
                editar: false,
                status: true,
                registerUser: {
                    email: '',
                    documento: '',
                    nombre: '',
                    apellido: '',
                    rol: '',
                    password: '',
                    salario: '',
                    celular: '',
                }

            };
        },
        methods: {

            enviarDatos(){
                this.$parent.volverFormulario();
            },
            saveRegister(){
                    console.log("datos enviados al registrar",this.registerUser);
                    axios.post('/registerUser', this.registerUser).then(respuesta => {
                    console.log("Respuesta ", respuesta.data);
                    Swal.fire(
                        'Registro Exitoso!',
                        'You clicked the button!',
                        'success'
                    )
                    this.$parent.listUser();
                    this.$parent.volverFormulario();
                }).catch(error => {
                    console.log("Error en servidor");
                    console.log(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Algo Salio mal!',
                    })
                    console.log(error.response);
                });
            }
        },
    };
</script>
