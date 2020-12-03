<template>
    <div>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>dirección</th>
                <th>Opciones</th>
            </tr>
            <tr v-for="tr in value" :key="tr.id">
                <td>{{ tr.nombre }}</td>
                <td>{{ tr.apellido }}</td>
                <td>{{ tr.direccion }}</td>
                <td>
                    <button v-on:click="$emit('editar', 'editar', tr)">Editar</button> | 
                    <button v-on:click="$emit('eliminar', tr.id)">Eliminar</button>
                </td>
            </tr>
        </table>
    </div>
</template>
<script>
    export default {
        props:["value"],
    }
</script>