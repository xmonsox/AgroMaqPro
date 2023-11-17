<template>
    <v-app>
        <v-main>
            <v-data-table :headers="headers" :items="desserts" sort-by="calories" class="elevation-1">
                <template v-slot:top>
                    <v-toolbar flat>
                        <v-toolbar-title>MACHINERY</v-toolbar-title>
                        <v-divider class="mx-4" inset vertical></v-divider>
                        <v-spacer></v-spacer>
                        <v-dialog v-model="dialog" max-width="500px">
                            <template v-slot:activator="{ on, attrs }">
                                <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                                    NEW MACHINERY
                                </v-btn>
                            </template>
                            <v-card>
                                <v-card-title>
                                    <span class="text-h5">{{ formTitle }}</span>
                                </v-card-title>

                                <v-card-text>
                                    <v-container>
                                        <v-row>
                                            <!-- <v-col cols="12" sm="6" md="4">
                                                <v-text-field v-model="registerSuppliers.id" label="Id"></v-text-field>
                                            </v-col> -->
                                            <v-col cols="12" sm="6" md="4">
                                                <v-text-field v-model="registerMachinery.matricula"
                                                    label="Matricula"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6" md="4">
                                                <v-text-field v-model="registerMachinery.nombre"
                                                    label="Nombre"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6" md="4">
                                                <v-text-field v-model="registerMachinery.cantidad"
                                                    label="Cantidad"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6" md="4">
                                                <!-- <v-text-field v-model="registerMachinery.tipo_maquinaria"
                                                    label="Tipo Maquinaria"></v-text-field> -->
                                                <v-select v-model="registerMachinery.tipo_maquinaria" :items="tipo"
                                                    :rules="[v => !!v || 'Item is required']" label="Tipo/Maquinaria"
                                                    required></v-select>
                                            </v-col>
                                            <v-col cols="12" sm="6" md="4">
                                                <v-select v-model="registerMachinery.estado" :items="status"
                                                    :rules="[v => !!v || 'Item is required']" label="ESTADO"
                                                    required></v-select>
                                            </v-col>

                                        </v-row>
                                    </v-container>
                                </v-card-text>

                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="blue darken-1" text @click="close">
                                        Cancel
                                    </v-btn>
                                    <v-btn color="blue darken-1" text @click="save">
                                        Save
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                        <v-dialog v-model="dialogDelete" max-width="500px">
                            <v-card>
                                <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
                                    <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                                    <v-spacer></v-spacer>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </v-toolbar>
                </template>
                <template v-slot:item.actions="{ item }">
                    <v-icon small class="mr-2" @click="editItem(item)">
                        mdi-pencil
                    </v-icon>
                    <v-icon small @click="deleteItem(item)">
                        mdi-delete
                    </v-icon>
                </template>
                <template v-slot:no-data>
                    <v-btn color="primary" @click="initialize">
                        Reset
                    </v-btn>
                </template>
            </v-data-table>
        </v-main>
    </v-app>
</template>
<script>
import Swal from 'sweetalert2';
export default {
    data: () => ({
        dialog: false,
        dialogDelete: false,
        headers: [
            {
                align: 'start',
                sortable: false,
                value: 'name',
            },
            { text: 'Nombre', value: 'nombre' },
            { text: 'Matricula', value: 'matricula' },
            { text: 'Cantidad', value: 'cantidad' },
            { text: 'TipoMaquinaria', value: 'tipo_maquinaria' },
            { text: 'Estado', value: 'estado' },
            { text: 'Actions', value: 'actions', sortable: false },
        ],
        desserts: [],
        editedIndex: -1,
        registerMachinery: {
            id: '',
            matricula: '',
            nombre: '',
            cantidad: '',
            tipo_maquinaria: '',
            estado: '',
        },
        defaultItem: {
            id: '',
            matricula: '',
            nombre: '',
            cantidad: '',
            tipo_maquinaria: '',
            estado: '',
        },
        select: null,
        tipo: [
            'Pesada',
            'Fragil',
            'Ligera',
            'Aseo',
            'Por definir',
        ],
        status: [
            'Activa',
            'Inactiva',
            'Mantenimiento',
            'Varada',
        ],
    }),

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
        },
    },

    watch: {
        dialog(val) {
            val || this.close()
        },
        dialogDelete(val) {
            val || this.closeDelete()
        },
    },

    created() {
        this.initialize()
    },

    methods: {
        initialize() {
            axios.get('/Machinery/MachineryShow').then(respuesta => {
                this.desserts = respuesta.data.machineryData;
                // this.updateSuppliers = false;
                // this.viewListSupp = true;
            }).catch(error => {
                console.log("Error en servidor");
                console.log(error);
                console.log(error.response);
            });
        },

        editItem(item) {
            this.editedIndex = this.desserts.indexOf(item)
            this.registerMachinery = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem(item) {
            this.editedIndex = this.desserts.indexOf(item)
            this.registerMachinery = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm() {
            axios.delete(`/Machinery/DeleteMachinery/${this.registerMachinery.id}`).then((response) => {
                if (response.data.status === true) {
                    // Actualiza la lista de usuarios después de la eliminación
                    // this.listSuppliers();
                    Swal.fire(
                        'Eiminado!',
                        'You clicked the button!',
                        'success'
                    );
                }
                this.desserts.splice(this.editedIndex, 1)
                this.registerMachinery = {}
            }).catch((error) => {
                console.log("Error al eliminar el Supplier: " + error);
            });
            this.closeDelete();
        },

        close() {
            this.dialog = false
            this.registerSuppliers = {}
            // this.$nextTick(() => {
            //     this.editedItem = Object.assign({}, this.defaultItem)
            //     this.editedIndex = -1
            // })
        },

        closeDelete() {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        save() {
            if (this.editedIndex > -1) {
                //console.log("Datos enviados al modificar", this.SuppEdit);
                axios.put(`/Machinery/UpdateMachinery/${this.registerMachinery.id}`, this.registerMachinery)
                    .then(respuesta => {
                        if (respuesta.data.status) {
                            console.log("Actualización exitosa");
                            Swal.fire(
                                'Excelente!',
                                'You clicked the button!',
                                'success'
                            );
                            this.desserts = respuesta.data.machineryData;
                            // this.$parent.BackList();
                            // this.$parent.listSuppliers();
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
            } else {
                axios.post('/registerMachinery', this.registerMachinery)
                    .then(respuesta => {
                        if (respuesta.data.status) {
                            console.log("Registro exitoso");
                            Swal.fire(
                                'Registro Exitoso!',
                                'You clicked the button!',
                                'success'
                            );
                            this.desserts = respuesta.data.machineryData;

                            // this.$parent.listSuppliers();
                            // this.$parent.BackList();
                        } else {
                            console.log("Error: Los datos están duplicados");
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Algo salio mal',
                            })
                        }
                    }).catch(error => {
                        if (error.response.status == 422) {
                            alert("Existe");
                        }
                        console.log("Error en servidor");
                        console.log(error);
                        console.log(error.response);
                    });

            }
            this.close()
        },
    },
}
</script>
