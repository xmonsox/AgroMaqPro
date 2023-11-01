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
                        <td><button class="btn btn-warning" @click="mostrarEditar(listSupp)"><i
                                    class="fa-solid fa-pen-to-square"></i></button></td>
                        <td><button class="btn btn-danger" @click="eliminarUsuario(listSupp.id)"><i
                                    class="fa-solid fa-trash"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <registersupplier v-if="!status"></registersupplier>
        <!-- <editar v-if="editar" :Userdata="userStatus"></editar> -->

    </div>
</template>
<script>
    import RegisterSupplier from "./RegisterSupplier.vue";
// import Editar from "./Editar.vue";
export default {
    components: {
        'registersupplier': RegisterSupplier,
        // 'editar': Editar,
    },
    data() {
        return {
            //crear arreglo
            listSupplier: [],
            userStatus: {},
            viewListSupp: true,
            viewEditar: false,
            status: true,
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
            // this.viewEditar = false;
            this.viewListSupp = true;

        },
        // mostrarEditar(Userdata) {
        //     this.userStatus = Userdata
        //     this.viewEditar = true;
        //     this.viewListSupp = false;
        //     this.status = true;
        // },
        // edit_status(Userdata){
        // },
        listSuppliers() {
            axios.get('/Suppliers/SuppliersShow').then(respuesta => {
                console.log("Respuesta del servidor");
                console.log(respuesta.data);
                this.listSupplier = respuesta.data.supplierData;
                this.viewListSupp = true;
            }).catch(error => {
                console.log("Error en servidor");
                console.log(error);
                console.log(error.response);
            });
        },
        // eliminarUsuario(id) {
        //     if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
        //         axios.delete(`/Users/DeleteUser/${id}`).then((response) => {
        //             if (response.data.status === true) {
        //                 // Actualiza la lista de usuarios después de la eliminación
        //                 this.listUser();
        //             }
        //         }).catch((error) => {
        //             console.log("Error al eliminar el usuario: " + error);
        //         });
        //     }
        // },
    },
};
</script>
