<template>
    <div class="container" >
        <div>
            <h3 class="text-center"><b>EDITAR USUARIO</b></h3>
            <form action="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Documento</label>
                            <input type="text" class="form-control" name="documento" v-model="documento" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" v-model="nombre" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Apellido</label>
                            <input type="text" class="form-control" name="documento" v-model="apellido" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">E-mail</label>
                            <input type="text" class="form-control" name="nombre" v-model="email" required>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-success" type="button" @click=" $parent.volverFormulario() ">Modificar</button>
                </div>
            </form>
        </div>
        <!-- <formulario v-if="!status"></formulario> -->
        <!-- <button class="btn btn-danger" type="button" @click="volverFormulario()">Volver</button> -->
    </div>
</template>
<script>
    export default {
        data(){
            return{
                //crear arreglo
                editar: true,
                status: true,
                email: '',
                documento: '',
                nombre: '',
                apellido: '',
            };
        },
        methods: {
            enviarDatos(){
                this.$parent.volverFormulario();
            },
            // volverFormulario(){
            //     this.status = true;
            // },
        },
    };
</script>
