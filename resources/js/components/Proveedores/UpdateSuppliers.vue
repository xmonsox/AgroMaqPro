<template>
    <div class="container">
        <div>
            <h3 class="text-center"><b>EDITAR PROVEEDOR</b></h3>
            <form action="">
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" class="form-control" name="id" v-model="SuppEdit.id">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" v-model="SuppEdit.nombre" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Telefono</label>
                            <input type="text" class="form-control" name="telefono" v-model="SuppEdit.telefono" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Direccion</label>
                            <input type="text" class="form-control" name="direccion" v-model="SuppEdit.direccion" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="email" v-model="SuppEdit.email" required>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-success" type="button" @click="UpdateSupplier()">Enviar</button>
                </div>
            </form>
        </div>
        <!-- <formulario v-if="!status"></formulario> -->
        <button class="btn btn-danger" type="button" @click="enviarDatos()">Volver</button>
    </div>
</template>
<script>
import Swal from 'sweetalert2'
export default {
    props: ['Supplierdata'],
    data() {
        return {
            //crear arreglo
            SuppEdit: {},
            editar: true,
            status: true,
            // email: '',
            // documento: '',
            // nombre: '',
            // apellido: '',
        };
    },
    created() {
        console.log("SupplierData ", this.Supplierdata);
        this.SuppEdit = this.Supplierdata;
        console.log("SuppEdit", this.SuppEdit);
    },
    methods: {
        enviarDatos() {
            this.$parent.BackList();
        },
        UpdateSupplier() {
            console.log("Datos enviados al modificar", this.SuppEdit);
            axios.put(`/Suppliers/UpdateSuppliers/${this.SuppEdit.id}`, this.SuppEdit)
                .then(respuesta => {
                    if (respuesta.data.status) {
                        console.log("Actualización exitosa");
                        Swal.fire(
                            'Excelente!',
                            'You clicked the button!',
                            'success'
                        )
                        this.$parent.BackList();
                        this.$parent.listSuppliers();
                    } else {
                        console.log("Error: Los datos están duplicados");
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Algo Salio mal! (puede ser un campo vacio)',
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
        },
    },
};
</script>
