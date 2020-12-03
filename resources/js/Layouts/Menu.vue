<template>
    <div>
        <inertia-link :href="route('dashboard')" :active="route().current('dashboard')" class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
            <i class="fa fa-university favics" aria-hidden="true"></i> <span class="mx-3">Inicio</span>
        </inertia-link>
        <inertia-link :href="route('usuarios.visualizar')" :active="route().current('usuarios.visualizar')" class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
            <i class="fa fa-users favics" aria-hidden="true"></i> <span class="mx-3">Usuarios</span>
        </inertia-link>
    </div>
</template>