<template>
    <div class="container" >
        <div>
            <h3 class="text-center"><b>AÑADIR USUARIO</b></h3>
            <form action="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" v-model="registerSuppliers.nombre" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Celular</label>
                            <input type="text" class="form-control" name="celular" v-model="registerSuppliers.celular" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Direccion</label>
                            <input type="text" class="form-control" name="direccion" v-model="registerSuppliers.direccion" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="email" v-model="registerSuppliers.email" required>
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
    export default {
        data(){
            return{
                //crear arreglo
                editar: false,
                status: true,
                registerSuppliers: {
                    nombre: '',
                    celular: '',
                    direccion: '',
                    email: '',
                }

            };
        },
        methods: {

            enviarDatos(){
                this.$parent.volverFormulario();
            },
            saveRegister(){
                    console.log("datos enviados al registrar",this.registerSuppliers);
                    axios.post('/registerSupplier', this.registerSuppliers).then(respuesta => {
                    console.log("Respuesta ", respuesta.data);
                    this.$parent.listSuppliers();
                    this.$parent.BackList();
                }).catch(error => {
                    console.log("Error en servidor");
                    console.log(error);
                    console.log(error.response);
                });
            }
        },
    };
</script>
