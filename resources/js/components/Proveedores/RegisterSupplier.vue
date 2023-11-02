<template>
    <div class="container">
        <div>
            <h3 class="text-center"><b>AÑADIR USUARIO</b></h3>
            <form action="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" v-model="registerSuppliers.nombre"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Telefono</label>
                            <input type="text" class="form-control" name="telefono" v-model="registerSuppliers.telefono"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Direccion</label>
                            <input type="text" class="form-control" name="direccion" v-model="registerSuppliers.direccion"
                                required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="email" v-model="registerSuppliers.email"
                                required>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-success" type="button" @click="saveRegister()">Enviar</button>
                </div>
            </form>
            <button class="btn btn-danger" type="button" @click="enviarDatos()">Volver</button>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            //crear arreglo
            editar: false,
            status: true,
            registerSuppliers: {
                nombre: '',
                telefono: '',
                direccion: '',
                email: '',
            }

        };
    },
    methods: {

        enviarDatos() {
            this.$parent.volverFormulario();
        },
        saveRegister() {
        console.log("Datos enviados al registrar", this.registerSuppliers);

        axios.post('/registerSupplier', this.registerSuppliers)
            .then(respuesta => {
                if (respuesta.data.status) {
                    console.log("Registro exitoso");
                    this.$parent.listSuppliers();
                    this.$parent.BackList();
                } else {
                    console.log("Error: Los datos están duplicados");
                    // Puedes mostrar una alerta aquí o realizar cualquier otra acción
                }
            })
            .catch(error => {
                if (error.response.status == 422) {
                    alert("Existe");
                }
                console.log("Error en servidor");
                console.log(error);
                console.log(error.response);
            });
        }
    },
};
</script>
