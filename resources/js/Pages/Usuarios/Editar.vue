<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Usuarios
            </h2>
        </template>

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
                        <tr v-for="tr in usuarios" :key="tr.id">
                            <td>{{ tr.nombre }}</td>
                            <td>{{ tr.apellido }}</td>
                            <td>{{ tr.direccion }}</td>
                            <td>
                                <button @click="editar(tr)">Editar</button> | 
                                <button @click="eliminar(tr.id)">Eliminar</button>
                            </td>
                        </tr>
                    </table>
                </div>
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
        data() {
            return {
                usuarios: []
            }
        },
        methods: {
            async listar(){
                try {
                    const rq = await axios.delete("/usuarios/visualizar");
                    this.usuarios = rq.data;
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
            editar(data){
                console.log(data);
            }
        },
        mounted() {
            this.listar();
        },
    }
</script>
