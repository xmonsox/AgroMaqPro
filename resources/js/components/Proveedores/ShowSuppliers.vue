<template>
    <v-app>
        <v-main>
            <v-card>
                <v-card-title>
                    PROVEEDORES
                    <v-spacer></v-spacer>
                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line
                        hide-details></v-text-field>
                </v-card-title>
                <v-data-table :headers="headers" :items="desserts" :search="search"></v-data-table>
            </v-card>
        </v-main>
    </v-app>
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
            search: '',
            headers: [
                {
                    // text: 'Dessert (100g serving)',
                    align: 'start',
                    sortable: false,
                    value: 'name',
                },
                { text: 'ID', value: 'id' },
                { text: 'Nombre', value: 'nombre' },
                { text: 'Telefono', value: 'telefono' },
                { text: 'Direccion', value: 'direccion' },
                { text: 'Email', value: 'email' },
            ],
            desserts: [],
        }
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
                this.desserts = respuesta.data.supplierData;
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
<!-- Muestra el componente para registrar un proveedor si status es falso
<registersupplier v-if="!status"></registersupplier>
Muestra el componente para actualizar un proveedor si updateSuppliers es verdadero y pasa los datos del proveedor a través de props
<updatesupplier v-if="updateSuppliers" :Supplierdata="supplierStatus"></updatesupplier> -->