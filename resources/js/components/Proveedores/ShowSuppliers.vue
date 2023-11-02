<template>
    <div class="container ">
        <div v-if="viewListSupp" style="height: 100vh; overflow-y: scroll;">
            <button class="btn btn-success mb-3 mt-1" @click="viewRegister()">AÑADIR PROVEEDOR</button>
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
                    <tr v-for="listSupp in listSupplier">
                        <th scope="row">{{ listSupp.id }}</th>
                        <td>{{ listSupp.nombre }}</td>
                        <td>{{ listSupp.telefono }}</td>
                        <td>{{ listSupp.direccion }}</td>
                        <td>{{ listSupp.email }}</td>
                        <td><button class="btn btn-warning" @click="showEditar(listSupp)"><i
                                    class="fa-solid fa-pen-to-square"></i></button></td>
                        <td><button class="btn btn-danger" @click="deleteSupplier(listSupp.id)"><i
                                    class="fa-solid fa-trash"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <registersupplier v-if="!status"></registersupplier>
        <updatesupplier v-if="updateSuppliers" :Supplierdata="supplierStatus"></updatesupplier>

    </div>
</template>
<script>
    import RegisterSupplier from "./RegisterSupplier.vue";
    import UpdateSuppliers from "./UpdateSuppliers.vue";
export default {
    components: {
        'registersupplier': RegisterSupplier,
        'updatesupplier': UpdateSuppliers,
    },
    data() {
        return {
            //crear arreglo
            listSupplier: [],
            supplierStatus: {},
            viewListSupp: true,
            viewEditar: false,
            status: true,
            updateSuppliers: true,
            // email: '',
            // documento: '',
            // nombre: '',
            // apellido: '',
        };
    },
    created() {
        this.listSuppliers();
    },
    methods: {
        viewRegister() {
            this.viewListSupp = false;
            this.status = false;
        },
        BackList() {
            this.status = true;
            this.viewEditar = false;
            this.viewListSupp = true;

        },
        showEditar(Supplierdata) {
            console.log("Datos recibidos:", Supplierdata);
            this.supplierStatus = Supplierdata;
            this.updateSuppliers = true;
            this.viewListSupp = false;
            this.status = true;
        },
        listSuppliers() {
            axios.get('/Suppliers/SuppliersShow').then(respuesta => {
                console.log("Respuesta del servidor");
                console.log(respuesta.data);
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
                    }
                }).catch((error) => {
                    console.log("Error al eliminar el Supplier: " + error);
                });
            }
        },

    },
};
</script>
