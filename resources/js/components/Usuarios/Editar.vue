<template>
    <div class="container" >
        <div>
            <h3 class="text-center"><b>EDITAR USUARIO</b></h3>
            <form action="">
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" class="form-control" name="id" v-model="datosEdit.id" required>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Documento</label>
                            <input type="text" class="form-control" name="documento" v-model="datosEdit.documento" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" v-model="datosEdit.nombre" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Apellido</label>
                            <input type="text" class="form-control" name="apellido" v-model="datosEdit.apellido" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Celular</label>
                            <input type="text" class="form-control" name="celular" v-model="datosEdit.celular" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">E-MAIL</label>
                            <input type="text" class="form-control" name="email" v-model="datosEdit.email" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">ROL</label>
                            <select class="form-select" aria-label="" name="rol" v-model="datosEdit.rol">
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
                            <input type="text" class="form-control" name="salario" v-model="datosEdit.salario" required>
                        </div>
                    </div>

                </div>
                <div class="text-center">
                    <button class="btn btn-success" type="button" @click="UpdateUser() ">EDITAR</button>
                </div>
            </form>
        </div>
        <!-- <formulario v-if="!status"></formulario> -->
        <button class="btn btn-danger" type="button" @click="general()">Volver</button>
    </div>
</template>
<script>
    export default {
        props:['Userdata'],
        data(){
            return{
                //crear arreglo
                datosEdit: {},
                editar: true,
                status: true,
                email: '',
                documento: '',
                nombre: '',
                apellido: '',
            };
        },
        created(){
            this.datosEdit = this.Userdata
        },
        methods: {
            general(){
                this.$parent.volverFormulario();
            },
            UpdateUser(){
                console.log("datos enviados al modificar",this.datosEdit);
                axios.put(`/Users/UpdateUsers/${this.datosEdit.id}`, this.datosEdit).then(respuesta => {
                    console.log("Respuesta del servidor");
                    console.log(respuesta.data);
                    Swal.fire(
                        'Excelente!',
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
            },
        },
    };
</script>
