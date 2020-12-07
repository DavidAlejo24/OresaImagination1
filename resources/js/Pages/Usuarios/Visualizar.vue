<template>
    <app-layout>
        <div class="flex flex-col">
            <div class="py-2 pb-8 overflow-x-auto sm:-mx-8 sm:px-6 lg:px-8 bg-white">
                <div class="mb-4 flex justify-between items-center">
                    <div class="flex-1 pr-4">
                        <div class="relative md:w-1/3">
                            <input type="text" class="w-full pl-10 pr-4 py-2 focus:outline-none focus:rounded-2xl focus:shadow-outline text-gray-600 font-medium inprel" placeholder="Buscar..." v-model="modal.buscar" @keyup="listarbusqueda">
                            <i @click="modal.buscar='';listarbusqueda()" v-if="modal.buscar" class="fa fa-close closesearch text-gray-600"></i>
                            <div class="absolute top-0 left-0 inline-flex items-center p-2">
                                <i class="fa fa-search w-6 h-6 text-gray-400 mt-1"></i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="shadow rounded-lg flex">
                            <div class="relative">
                                <button v-on:click="abrir_modal('crear')" class="rounded-lg inline-flex items-center hover:text-grey-500 focus:outline-none focus:shadow-outline text-white font-semibold py-2 px-2 md:px-4 bg-blue-900">
                                    Agregar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre</th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Apellido</th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Dirección</th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider opciones">
                                    Opciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr v-for="(tr, $index) in listas.usuarios" :key="$index">
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-gray-500">
                                    {{ tr.nombre }} {{tr.id}}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-gray-500">
                                    {{ tr.apellido }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-gray-500">
                                    {{ tr.direccion }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500 opciones"> 
                                    <button @click="abrir_modal('editar', tr)" class="focus:outline-none">
                                        <i class="fa fa-eye"></i>
                                    </button> |
                                    <button @click="abrir_modal('editar', tr)" class="focus:outline-none">
                                        <i class="fa fa-edit"></i>
                                    </button> |
                                    <button @click="eliminar(tr.id)" class="focus:outline-none">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="py-4">
                <infinite-loading spinner="bubbles" :identifier="modal.recargar" @infinite="listar">
                    <div slot="no-more">Todos los resultados</div>
                    <div slot="no-results">Sin Resultados</div>
                </infinite-loading>
            </div>

            <modal-jet :show="modal.estado" @close="modal.estado=!modal.estado">
                <template #title>
                    {{modal.titulo}}
                </template>
                <template #content>
                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-2">
                            <label class="block font-medium text-sm text-gray-700" for="nombre"><span>Nombre</span></label> 
                            <input class="form-input w-full focus:outline-none inprel" id="nombre" v-model="modal.datos.nombre"/>
                            <div class="mt-2" style="display: none;">
                                <p class="text-sm text-red-600"></p>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <label class="block font-medium text-sm text-gray-700" for="apellido"><span>Apellido</span></label> 
                            <input class="form-input w-full focus:outline-none inprel" id="apellido" v-model="modal.datos.apellido"/>
                            <div class="mt-2" style="display: none;">
                                <p class="text-sm text-red-600"></p>
                            </div>
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700" for="edad"><span>Edad</span></label> 
                            <input class="form-input w-full focus:outline-none inprel" id="edad" v-model="modal.datos.edad"/>
                            <div class="mt-2" style="display: none;">
                                <p class="text-sm text-red-600"></p>
                            </div>
                        </div>
                        <div class="col-span-3">
                            <label class="block font-medium text-sm text-gray-700" for="direccion"><span>Dirección</span></label> 
                            <input class="form-input w-full focus:outline-none inprel" id="direccion" v-model="modal.datos.direccion"/>  
                            <div class="mt-2" style="display: none;">
                                <p class="text-sm text-red-600"></p>
                            </div> 
                        </div>
                    </div>
                </template>
                <template #footer>
                    <button v-if="modal.tipo==1" @click="crear()" class="rounded-lg inline-flex items-center hover:text-grey-500 focus:outline-none focus:shadow-outline text-white font-semibold py-2 px-2 md:px-4 bg-blue-900" block>Crear</button>
                    <button block v-else @click="editar()" class="rounded-lg inline-flex items-center hover:text-grey-500 focus:outline-none focus:shadow-outline text-white font-semibold py-2 px-2 md:px-4 bg-blue-900">Editar</button>
                    <button @click="modal.estado=!modal.estado" class="rounded-lg inline-flex items-center hover:text-grey-500 focus:outline-none focus:shadow-outline text-white font-semibold py-2 px-2 md:px-4 bg-red-600">Cancelar</button>
                </template>
            </modal-jet>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout';
    import Welcome from '@/Jetstream/Welcome';
    import ModalJet from '@/Jetstream/DialogModal';
    
    export default {
        props:{
            user: Object
        },
        components: {
            AppLayout,
            Welcome,
            ModalJet
        },
        //data: crear variables para utilizar dentro del componente
        data() {
            return {
                show:true,
                listas: {
                    usuarios: [],
                },
                modal:{
                    pagina:1,
                    buscar:"",
                    preloader:false,
                    recargar:+new Date(),
                    timeout:null,
                    estado:false,
                    titulo:"",
                    tipo:null,
                    datos:{
                        id:null,
                        nombre:"",
                        apellido:"",
                        direccion:"",
                        edad:null
                    }
                }
            }
        },
        methods: {
            async listar($state){
                try {
                    const { data } = await axios.get("/usuarios/listar?page=" + this.modal.pagina + "&buscar=" + this.modal.buscar);
                    let datos = data.data;
                    if(datos.length){
                        this.modal.pagina++;
                        this.listas.usuarios = this.listas.usuarios.concat(datos);
                        $state.loaded();
                    }else{
                        $state.complete();
                    }
                    this.modal.preloader=false;
                } catch (error) {
                    console.log(error);
                    this.modal.preloader=false;
                }
            },
            listarbusqueda(){
                if (this.modal.timeout) {  
                    clearTimeout(this.modal.timeout);
                }
                this.modal.timeout =  setTimeout(() => {
                    this.modal.pagina = 1;
                    this.listas.usuarios = [];
                    this.modal.recargar++;
                }, 500);
            },
            abrir_modal(tipo, data){
                switch(tipo) {
                    case 'crear':
                        this.modal.estado = true;
                        this.modal.titulo = "Crear Usuario";
                        this.modal.tipo = 1;
                        this.modal.datos = {
                            id:null,
                            nombre:"",
                            apellido:"",
                            direccion:"",
                            edad:null
                        }
                    break;
                    case 'editar':
                        this.modal.estado = true;
                        this.modal.titulo = "Editar Usuario";
                        this.modal.tipo = 2;
                        this.modal.datos = {
                            id: data.id,
                            nombre:data.nombre,
                            apellido:data.apellido,
                            direccion:data.direccion,
                            edad:data.edad
                        }
                    break;
                }
            },
            async crear(){
                try {
                    const rq = await axios.post("/usuarios/crear", this.modal.datos);
                    this.listarbusqueda();
                    this.cerrar();
                } catch (error) {
                    console.log(error);
                }
            },
            async editar(){
                try {
                    const rq = await axios.put("/usuarios/editar", this.modal.datos);
                    this.listarbusqueda();
                    this.cerrar();
                } catch (error) {
                    console.log(error);
                }
            },
            async eliminar(id){
                try {
                    const rq = await axios.delete("/usuarios/eliminar/"+id);
                    this.listarbusqueda();
                } catch (error) {
                    console.log(error);
                }
            },
            cerrar(){
                this.modal.estado = false;
                this.modal.datos = {
                    id:null,
                    nombre:"",
                    apellido:"",
                    direccion:"",
                    edad:null
                }
            }
        }
    }
</script>
<style>
    .inprel{
        border:none!important;
        border-bottom: 1px solid #d2d6dc!important;
        border-radius: 0!important;
    }
    .closesearch{
        position: absolute;
        top: 10px;
        right: 15px;
        cursor: pointer;
    }
    .opciones{
        width: 115px;
    }
</style>