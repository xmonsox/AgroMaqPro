<template>
    <div class="container">
        <div>
            <h3 class="text-center"><b>AÑADIR PROVEEDOR</b></h3>
            <form action="">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" v-model="registerSuppliers.nombre"
                        required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono"
                        v-model="registerSuppliers.telefono" required>
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Direccion</label>
                    <input type="text" class="form-control" id="direccion" name="direccion"
                        v-model="registerSuppliers.direccion" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" v-model="registerSuppliers.email"
                        required>
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
import Swal from 'sweetalert2'
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
            this.$parent.BackList();
        },
        saveRegister() {
            console.log("Datos enviados al registrar", this.registerSuppliers);

            axios.post('/registerSupplier', this.registerSuppliers)
                .then(respuesta => {
                    if (respuesta.data.status) {
                        console.log("Registro exitoso");
                        Swal.fire(
                            'Registro Exitoso!',
                            'You clicked the button!',
                            'success'
                        )
                        this.$parent.listSuppliers();
                        this.$parent.BackList();
                    } else {
                        console.log("Error: Los datos están duplicados");
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Algo salio mal',
                        })
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
