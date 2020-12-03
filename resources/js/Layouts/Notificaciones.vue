<template>
    <div x-data="{ notificationOpen: false }" class="relative">
        <button @click="notificationOpen = ! notificationOpen" class="flex mx-4 text-gray-600 focus:outline-none">
            <i class="fa fa-bell" aria-hidden="true" style="font-size: 20px;"></i>
        </button>

        <div x-show="notificationOpen" :class="{'visible': !notificationOpen}" @click="notificationOpen = false" class="fixed inset-0 h-full w-full z-10"></div>
        <div x-show="notificationOpen" :class="{'visible': !notificationOpen}" class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl overflow-hidden z-10" style="width: 20rem;">
            <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:text-white hover:bg-indigo-600 -mx-2">
                <img class="h-8 w-8 rounded-full object-cover mx-1" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=334&amp;q=80" alt="avatar">
                <p class="text-sm mx-2">
                    <span class="font-bold" href="#">Sara Salah</span> replied on the <span class="font-bold text-indigo-400" href="#">Upload Image</span> artical . 2m
                </p>
            </a>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            notificationOpen:false,
        }
    },
}
</script>