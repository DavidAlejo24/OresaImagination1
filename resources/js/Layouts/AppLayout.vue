<template>
    <div class="min-h-screen bg-gray-100">
        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
            <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>
        
            <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
                <div class="flex items-center justify-center mt-8">
                    <div class="flex items-center">
                        <img src="/img/logotipo-imagination.png" style="width: 200px;">
                    </div>
                </div>
        
                <nav class="mt-10">
                    <menu-link/>
                </nav>
            </div>
            <div class="flex-1 flex flex-col overflow-hidden">
                <header class="flex justify-between items-center py-4 px-6 bg-white border-b-4 border-indigo-600">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </button>
        
                        <div class="relative mx-4 lg:mx-0">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                <i class="fa fa-search text-gray-500" aria-hidden="true"></i>
                            </span>
                            <input class="form-input w-32 sm:w-64 rounded-md pl-10 pr-4 focus:border-indigo-600" type="text" placeholder="Buscar...">
                        </div>
                    </div>
        
                    <div class="flex items-center">
                        <notificaciones-link/>
                        <submenu-link/>
                    </div>
                </header>
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container mx-auto px-6 py-8">
                        <slot></slot>
                    </div>
                </main>
            </div>
        </div>
        <!-- Modal Portal -->
        <portal-target name="modal" multiple>
        </portal-target>
    </div>
</template>

<script>
    import MenuLink from './Menu'
    import NotificacionesLink from './Notificaciones'
    import SubmenuLink from './Submenu'
    export default {
        components: {
            MenuLink,
            NotificacionesLink,
            SubmenuLink
        },
        data() {
            return {
                showingNavigationDropdown: false,
                sidebarOpen:false
            }
        }
    }
</script>
<style>
    .visible{
        display:none;
    }
</style>