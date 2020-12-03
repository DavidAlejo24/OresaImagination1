<template>
    <div x-data="{ dropdownOpen: false }" class="relative">
        <button @click="dropdownOpen = ! dropdownOpen" class="relative block h-8 w-8 rounded-full overflow-hidden shadow focus:outline-none">
            <img class="h-full w-full object-cover" src="https://images.unsplash.com/photo-1528892952291-009c663ce843?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=296&amp;q=80" alt="Your avatar">
        </button>
        <div x-show="dropdownOpen" :class="{'visible': !dropdownOpen}" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>
        <div x-show="dropdownOpen" :class="{'visible': !dropdownOpen}" class="absolute right-0 mt-2 w-40 bg-white rounded-md overflow-hidden shadow-xl z-10">
            <inertia-link :href="route('profile.show')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">
                <i class="fa fa-user favics" aria-hidden="true"></i> Mi Perfil
            </inertia-link>
            <a href="javascript:void(0)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white" @click="logout">
                <i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar Sesión
            </a>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            dropdownOpen:false
        }
    },
    methods: {
        logout() {
            axios.post(route('logout').url()).then(response => {
                window.location = '/';
            })
        },
    }
}
</script>

<style>
    .favics{
        font-size: 16px;
        margin-right: 4px
    }
</style>