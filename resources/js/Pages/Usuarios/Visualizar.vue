<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Usuarios
            </h2>
        </template>
        <vs-button @click="abrir_modal('crear')">
            Crear Usuario
        </vs-button>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>dirección</th>
                            <th>Opciones</th>
                        </tr>
                        <tr v-for="tr in listas.usuarios" :key="tr.id">
                            <td>{{ tr.nombre }}</td>
                            <td>{{ tr.apellido }}</td>
                            <td>{{ tr.direccion }}</td>
                            <td>
                                <button @click="abrir_modal('editar', tr)">Editar</button> | 
                                <button @click="eliminar(tr.id)">Eliminar</button>
                            </td>
                        </tr>
                    </table>
                </div>
                <vs-dialog v-model="modal.estado">
                    <template #header>
                        <h4 class="not-margin">
                            {{modal.titulo}}
                        </h4>
                    </template>
                    <div class="con-form">
                        <label class="mt">Nombre</label>
                        <vs-input placeholder="Nombre" class="w-100" v-model="modal.datos.nombre"></vs-input>

                        <label class="mt">Apellido</label>
                        <vs-input placeholder="Apellido" class="w-100" v-model="modal.datos.apellido"></vs-input>

                        <label class="mt">Edad</label>
                        <vs-input placeholder="Edad" class="w-100" v-model="modal.datos.edad"></vs-input>

                        <label class="mt">Dirección</label>
                        <vs-input placeholder="Dirección" class="w-100" v-model="modal.datos.direccion"></vs-input>
                    </div>
                    <template #footer>
                        <div class="footer-dialog">
                            <vs-button block v-if="modal.tipo==1">Crear</vs-button>
                            <vs-button block v-else>Editar</vs-button>
                        </div>
                    </template>
                </vs-dialog>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'

    export default {
        props:{
            user: Object
        },
        components: {
            AppLayout,
            Welcome,
        },
        //data: crear variables para utilizar dentro del componente
        data() {
            return {
                listas: {
                    usuarios: [],
                },
                modal:{
                    estado:false,
                    titulo:"",
                    tipo:null,
                    datos:{
                        nombre:"",
                        apellido:"",
                        direccion:"",
                        edad:null
                    }
                }
            }
        },
        methods: {
            async listar(){
                try {
                    const rq = await axios.delete("/usuarios/visualizar");
                    this.listas.usuarios = rq.data;
                } catch (error) {
                    console.log(error);
                }
            },
            async eliminar(id){
                try {
                    const rq = await axios.delete("/usuarios/eliminar/"+id);
                    this.listar();
                    console.log(rq);
                } catch (error) {
                    console.log(error);
                }
            },
            abrir_modal(tipo, data){
                switch(tipo) {
                    case 'crear':
                        this.modal = {
                            estado:true,
                            titulo:"Crear Usuario",
                            tipo:1,
                            datos:{
                                nombre:"",
                                apellido:"",
                                direccion:"",
                                edad:null
                            }
                        } 
                    break;
                    case 'editar':
                        this.modal = {
                            estado:true,
                            titulo:"Editar Usuario",
                            tipo:2,
                            datos:{
                                nombre:data.nombre,
                                apellido:data.apellido,
                                direccion:data.direccion,
                                edad:data.edad
                            }
                        } 
                    break;
                }
            }
        },
        mounted() {
            this.listar();
        },
    }
</script>
<style>
    .w-100 input{
        width: 100%;
    }
    .mt{
        margin-top: 15px;
        display:block;
    }
</style>