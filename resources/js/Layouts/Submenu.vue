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
            <inertia-link :href="route('api-tokens.index')" v-if="$page.jetstream.hasApiFeatures" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">
                <i class="fa fa-barcode favics" aria-hidden="true"></i> API Tokens
            </inertia-link>
            <div class="border-t border-gray-100"></div>
            <template v-if="$page.jetstream.hasTeamFeatures">
                <div class="block px-4 py-2 text-xs text-gray-400">Administrar equipo</div>
                <inertia-link :href="route('teams.show', $page.user.current_team)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">
                    <i class="fa fa-cogs favics" aria-hidden="true"></i> Config. Team
                </inertia-link>
                <inertia-link :href="route('teams.create')" v-if="$page.jetstream.canCreateTeams" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">
                    <i class="fa fa-object-group favics" aria-hidden="true"></i> Crear Team
                </inertia-link>
                <div class="border-t border-gray-100"></div>
                <div class="block px-4 py-2 text-xs text-gray-400">Cambiar de equipo</div>
                <template v-for="team in $page.user.all_teams">
                    <form @submit.prevent="switchToTeam(team)" :key="team.id">
                        <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white w-full">
                            <div class="flex items-center">
                            <svg v-if="team.id == $page.user.current_team_id" class="mr-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <i v-else class="fa fa-circle-o mr-2 h-5 w-5 text-yellow-400" style="font-size: 16px;" aria-hidden="true"></i>
                            <div>{{ team.name }}</div>
                            </div>
                        </button>
                    </form>
                </template>
                <div class="border-t border-gray-100"></div>
            </template>
            <div class="border-t border-gray-100"></div>
            <a href="javascript:void(0)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white" @click="logout">
                <i class="fa fa-sign-out-alt" aria-hidden="true"></i> Cerrar Sesión
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
        switchToTeam(team) {
            this.$inertia.put(route('current-team.update'), {'team_id': team.id }, { preserveState: false });
        },
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