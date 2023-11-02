<template>
    <div class="container mt-3">
        <div class="">
            <h3 class="text-center"><b>AÑADIR REPUESTOS</b></h3>
            <form action="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="serial" class="form-label">SERIAL</label>
                            <input type="text" class="form-control" id="serial" name="serial"
                                v-model="registerRepuestos.serial" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tipo_repuesto" class="form-label">TIPO/REPUESTO</label>
                            <select class="form-select" id="tipo_repuesto" name="tipo_repuesto"
                                v-model="registerRepuestos.tipo_repuesto" required>
                                <option value="" disabled>Selecciona un tipo de repuesto</option>
                                <option value="Filtros">Filtros</option>
                                <option value="Correas">Correas</option>
                                <option value="Cuchillas">Cuchillas</option>
                                <option value="Neumáticos">Neumáticos</option>
                                <option value="Piezas de motor">Piezas de motor</option>
                                <option value="Piezas de transmisión">Piezas de transmisión</option>
                                <option value="Rodamientos">Rodamientos</option>
                                <option value="Componentes hidráulicos">Componentes hidráulicos</option>
                                <option value="Componentes eléctricos">Componentes eléctricos</option>
                                <option value="Sensores y sistemas de control">Sensores y sistemas de control</option>
                                <option value="Accesorios y implementos">Accesorios y implementos</option>
                                <option value="Partes de la cabina">Partes de la cabina</option>
                                <option value="Sistemas de escape">Sistemas de escape</option>
                                <option value="Herramientas y consumibles">Herramientas y consumibles</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="cantidad" class="form-label">CANTIDAD</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad"
                                v-model="registerRepuestos.cantidad" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="precio_compra" class="form-label">P/COMPRA</label>
                            <input type="number" class="form-control" id="precio_compra" name="precio_compra"
                                v-model="registerRepuestos.precio_compra" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">DESCRIPCION</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion"
                                v-model="registerRepuestos.descripcion" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="estado" class="form-label">NOMBRE</label>
                            <input type="text" class="form-control" id="estado" name="nombre"
                                v-model="registerRepuestos.nombre" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 center">
                        <div class="mb-3">
                            <label for="estado" class="form-label">ESTADO</label>
                            <select class="form-select" value="Disponible" id="estado" name="estado" v-model="registerRepuestos.estado"
                                required>
                                <option value="" disabled>Selecciona un estado</option>
                                <option value="Disponible">Disponible</option>
                                <option value="Pedir">Pedir</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="id_proveedor" class="form-label">ID/PROVEEDOR</label>
                        <select class="form-select" id="id_proveedor" name="id_proveedor"
                            v-model="registerRepuestos.id_proveedor" required>
                            <option value="" disabled>Selecciona un proveedor</option>
                            <option v-for="proveedor in proveedores" :value="proveedor.id">{{ proveedor.nombre }}</option>
                        </select>
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
import Swal from 'sweetalert2'
export default {
    data() {
        return {
            //crear arreglo
            editar: false,
            status: true,
            proveedores: [], // Esta propiedad almacenará la lista de proveedores
            registerRepuestos: {
                serial: '',
                nombre: '',
                tipo_repuesto: '',
                cantidad: '',
                precio_compra: '',
                descripcion: '',
                id_proveedor: '',
                estado: '',
            }
        };
    },
    created() {
        this.getProveedores();
        console.log("Datos del proveedor", this.proveedores);
    },
    methods: {
        enviarDatos() {
            this.$parent.BackList();
        },
        getProveedores() {
            console.log("Datos del proveedor", this.proveedores);
            axios.get('/TraerProveedores').then(respuesta => {
                this.proveedores = respuesta.data.proveedores;
            }).catch((error) => {
                console.error('Error al obtener la lista de proveedores: ', error);
            });
        },
        saveRegister() {
            console.log("Datos enviados al registrar", this.registerRepuestos);
            axios.post('/registerRepuesto', this.registerRepuestos).then(respuesta => {
                if (respuesta.data.status) {
                    console.log("Registro exitoso");
                    Swal.fire(
                        'Registro Exitoso!',
                        'You clicked the button!',
                        'success'
                    )
                    this.$parent.listRepuest();
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
