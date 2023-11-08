<template>
    <div class="container">
        <!-- Muestra la lista de proveedores si viewListRepuesto es verdadero -->
        <div v-if="viewListRepuesto" style="height: 100vh; overflow-y: scroll;">
            <!-- Botón para agregar un proveedor -->
            <button class="btn btn-success mb-3 mt-1" @click="viewRegister()">REGISTRA/REPUESTO</button>
            <!-- Tabla para mostrar la lista de proveedores -->
            <table class="table mb-3">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">SERIAL</th>
                        <th scope="col">TIPO/REPUESTO</th>
                        <th scope="col">CANTIDAD</th>
                        <th scope="col">P/COMPRA</th>
                        <th scope="col">DESCRIPCION</th>
                        <th scope="col">ID/PROVEEDOR</th>
                        <th scope="col">ESTADO</th>
                        <th scope="col">EDITAR</th>
                        <th scope="col">ELIMINAR</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Itera sobre la lista de proveedores y muestra sus detalles -->
                    <tr v-for="listRepue in listRepuestos">
                        <th scope="row">{{ listRepue.id }}</th>
                        <td>{{ listRepue.nombre }}</td>
                        <td>{{ listRepue.serial }}</td>
                        <td>{{ listRepue.tipo_repuesto }}</td>
                        <td>{{ listRepue.cantidad }}</td>
                        <td>{{ listRepue.precio_compra }}</td>
                        <td>{{ listRepue.descripcion }}</td>
                        <td>{{ listRepue.id_proveedor }}</td>
                        <td>{{ listRepue.estado }}</td>
                        <!-- Botón para editar un proveedor -->
                        <td><button class="btn btn-warning" @click="showEditar(listRepue)"><i
                                    class="fa-solid fa-pen-to-square"></i></button></td>
                        <!-- Botón para eliminar un proveedor -->
                        <td><button class="btn btn-danger" @click="deleteRepuesto(listRepue.id)"><i
                                    class="fa-solid fa-trash"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Muestra el componente para registrar un proveedor si status es falso -->
        <registerrepuesto v-if="!status"></registerrepuesto>
        <!-- Muestra el componente para actualizar un proveedor si updateSuppliers es verdadero y pasa los datos del proveedor a través de props -->
        <updaterepuesto v-if="viewUpdate" :Repuestodata="repuestoStatus"></updaterepuesto>
    </div>
</template>
<script>
import RegisterRepuestos from "./RegisterRepuestos.vue";
import UpdateRepuesto from "./UpdateRepuestos.vue";
//import Swal from 'sweetalert2'
export default {
    components: {
        'registerrepuesto': RegisterRepuestos,
        'updaterepuesto': UpdateRepuesto,
    },
    data() {
        return {
            // Creación de variables de datos
            listRepuestos: [], // Almacena la lista de repuestos
            repuestoStatus: {}, // Almacena los datos de un proveedor seleccionado
            viewListRepuesto: true, // Controla la visualización de la lista de proveedores
            viewEditar: false, // Controla la visualización de la vista de edición
            status: true, // Controla la visualización del formulario de registro
            viewUpdate: true, // Controla la visualización de la vista de actualización
        };
    },
    created() {
        // Ejecuta la función listSuppliers al cargar el componente
        this.listRepuest();
    },
    methods: {
        //Muestra el formulario de registro de proveedores
        viewRegister() {
            this.viewListRepuesto = false;
            this.status = false;
        },
        //Vuelve a la lista de proveedores
        BackList() {
            this.status = true;
            this.viewUpdate = false;
            this.viewListRepuesto = true;
        },
        //Muestra la vista de edición de un proveedor y pasa sus datos
        showEditar(Repuestodata) {
            this.repuestoStatus = Repuestodata;
            this.viewUpdate = true;
            this.viewListRepuesto = false;
            this.status = true;
        },
        // Obtiene la lista de proveedores desde el servidor
        listRepuest() {
            axios.get('/Repuestos/RepuestosShow').then(respuesta => {
                this.listRepuestos = respuesta.data.repuestoData;
                this.viewUpdate = false;
                this.viewListRepuesto = true;
            }).catch(error => {
                console.log("Error en servidor");
                console.log(error);
                console.log(error.response);
            });
        },
        deleteRepuesto(id) {
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
                    axios.delete(`/Repuestos/DeleteRepuestos/${id}`).then((response) => {
                        if (response.data.status === true) {
                            // Actualiza la lista de usuarios después de la eliminación
                            this.listRepuest();
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
