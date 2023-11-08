<template>
    <div class="container ">
        <div v-if="general" style="height: 100vh; overflow-y: scroll;">
            <button class="btn btn-success mb-3 mt-1" @click="enviarDatos()">AÑADIR USUARIO</button>
            <table class="table mb-3">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">DOCUMENTO</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">APELLIDO</th>
                        <th scope="col">CELULAR</th>
                        <th scope="col">E-MAIL</th>
                        <th scope="col">ROL</th>
                        <th scope="col">SALARIO</th>
                        <th scope="col">EDITAR</th>
                        <th scope="col">ELIMINAR</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="listUsers in listUsuarios">
                        <th scope="row">{{ listUsers.id }}</th>
                        <td>{{ listUsers.documento }}</td>
                        <td>{{ listUsers.nombre }}</td>
                        <td>{{ listUsers.apellido }}</td>
                        <td>{{ listUsers.celular }}</td>
                        <td>{{ listUsers.email }}</td>
                        <td>{{ listUsers.rol }}</td>
                        <td>{{ listUsers.salario }}</td>
                        <td><button class="btn btn-warning" @click="mostrarEditar(listUsers)"><i
                                    class="fa-solid fa-pen-to-square"></i></button></td>
                        <td><button class="btn btn-danger" @click="eliminarUsuario(listUsers.id)"><i
                                    class="fa-solid fa-trash"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <formulario v-if="!status"></formulario>
        <editar v-if="editar" :Userdata="userStatus"></editar>

    </div>
</template>
<script>
import Formulario from "./Formulario.vue";
import Editar from "./Editar.vue";
export default {
    components: {
        'formulario': Formulario,
        'editar': Editar,
    },
    data() {
        return {
            listUsuarios: [],
            userStatus: {},
            general: true,
            editar: false,
            status: true,
            email: '',
            documento: '',
            nombre: '',
            apellido: '',
        };
    },
    created() {
        this.listUser();
    },
    methods: {
        enviarDatos() {
            this.general = false;
            this.status = false;
        },
        volverFormulario() {
            this.status = true;
            this.editar = false;
            this.general = true;

        },
        mostrarEditar(Userdata) {
            this.userStatus = Userdata
            this.editar = true;
            this.general = false;
            this.status = true;
        },
        // edit_status(Userdata){
        // },
        listUser() {
            axios.get('/User/usuariosShow').then(respuesta => {
                console.log("Respuesta del servidor");
                console.log(respuesta.data);
                this.listUsuarios = respuesta.data.userData;
            }).catch(error => {
                console.log("Error en servidor");
                console.log(error);
                console.log(error.response);
            });
        },
        eliminarUsuario(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/Users/DeleteUser/${id}`).then((response) => {
                        if (response.data.status === true) {
                            this.listUser();
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                            'success'
                            )
                        }
                    }).catch((error) => {
                        console.log("Error al eliminar el Supplier: " + error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Algo Salio mal!',
                        })
                    });
                }
            })
                    
        },
    },
};
</script>
