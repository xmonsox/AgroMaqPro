<template>
    <div class="container">
        <!-- Muestra la lista de proveedores si viewListSupp es verdadero -->
        <div v-if="viewListSupp" style="height: 100vh; overflow-y: scroll;">
            <!-- Botón para agregar un proveedor -->
            <button class="btn btn-success mb-3 mt-1" @click="viewRegister()">AÑADIR PROVEEDOR</button>
            <!-- Tabla para mostrar la lista de proveedores -->
            <table class="table mb-3">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">TELEFONO</th>
                        <th scope="col">DIRECCION</th>
                        <th scope="col">E-MAIL</th>
                        <th scope="col">EDITAR</th>
                        <th scope="col">ELIMINAR</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Itera sobre la lista de proveedores y muestra sus detalles -->
                    <tr v-for="listSupp in listSupplier">
                        <th scope="row">{{ listSupp.id }}</th>
                        <td>{{ listSupp.nombre }}</td>
                        <td>{{ listSupp.telefono }}</td>
                        <td>{{ listSupp.direccion }}</td>
                        <td>{{ listSupp.email }}</td>
                        <!-- Botón para editar un proveedor -->
                        <td><button class="btn btn-warning" @click="showEditar(listSupp)"><i
                                class="fa-solid fa-pen-to-square"></i></button></td>
                        <!-- Botón para eliminar un proveedor -->
                        <td><button class="btn btn-danger" @click="deleteSupplier(listSupp.id)"><i
                                class="fa-solid fa-trash"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Muestra el componente para registrar un proveedor si status es falso -->
        <registersupplier v-if="!status"></registersupplier>
        <!-- Muestra el componente para actualizar un proveedor si updateSuppliers es verdadero y pasa los datos del proveedor a través de props -->
        <updatesupplier v-if="updateSuppliers" :Supplierdata="supplierStatus"></updatesupplier>
    </div>
</template>
<script>
import RegisterSupplier from "./RegisterSupplier.vue";
import UpdateSuppliers from "./UpdateSuppliers.vue";
import Swal from 'sweetalert2'
export default {
    components: {
        'registersupplier': RegisterSupplier,
        'updatesupplier': UpdateSuppliers,
    },
    data() {
        return {
            // Creación de variables de datos
            listSupplier: [], // Almacena la lista de proveedores
            supplierStatus: {}, // Almacena los datos de un proveedor seleccionado
            viewListSupp: true, // Controla la visualización de la lista de proveedores
            viewEditar: false, // Controla la visualización de la vista de edición
            status: true, // Controla la visualización del formulario de registro
            updateSuppliers: true, // Controla la visualización de la vista de actualización
        };
    },
    created() {
        // Ejecuta la función listSuppliers al cargar el componente
        this.listSuppliers();
    },
    methods: {
        // Muestra el formulario de registro de proveedores
        viewRegister() {
            this.viewListSupp = false;
            this.status = false;
        },
        // Vuelve a la lista de proveedores
        BackList() {
            this.status = true;
            this.viewEditar = false;
            this.viewListSupp = true;
        },
        // Muestra la vista de edición de un proveedor y pasa sus datos
        showEditar(Supplierdata) {
            this.supplierStatus = Supplierdata;
            this.updateSuppliers = true;
            this.viewListSupp = false;
            this.status = true;
        },
        // Obtiene la lista de proveedores desde el servidor
        listSuppliers() {
            axios.get('/Suppliers/SuppliersShow').then(respuesta => {
                this.listSupplier = respuesta.data.supplierData;
                this.updateSuppliers = false;
                this.viewListSupp = true;
            }).catch(error => {
                console.log("Error en servidor");
                console.log(error);
                console.log(error.response);
            });
        },
        deleteSupplier(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este Supplier?')) {
                axios.delete(`/Suppliers/DeleteSuppliers/${id}`).then((response) => {
                    if (response.data.status === true) {
                        // Actualiza la lista de usuarios después de la eliminación
                        this.listSuppliers(); // Cambia listSupplier a listSuppliers
                        Swal.fire(
                            'Eiminado!',
                            'You clicked the button!',
                            'success'
                        )
                    }
                }).catch((error) => {
                    console.log("Error al eliminar el Supplier: " + error);
                });
            }
        },

    },
};
</script>
