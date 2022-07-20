<template>
    <div class="container">
        <div class="search-box text-left mb-10">
            <form v-on:submit.prevent="filterUsers">
                <input type="text" class="mr-5" placeholder="Search..." v-model="searchTerm" />
                <button type="submit" class="btn">Search</button>
            </form>
            <div style="margin-left: auto;">
                <div v-if="users?.length == 0">
                    No hay datos para mostrar.
                </div>

                <div v-if="loading == true">
                    Cargando...
                </div>
            </div>
        </div>

        <div class="wrapper">
            <div v-for="user in users" :key="user.id">
                <UserCard :user="user" />
            </div>
        </div>

        <div class="mt-10">
            <button class="btn mr-5" type="button" v-if="serverPage > 0 && users.length > 0" v-on:click="prevPage"
                :disabled="loading">
                Anterior
            </button>

            <button type="button" class="btn" v-if="pageSize * (serverPage + 1) < total && users.length > 0"
                v-on:click="nextPage" :disabled="loading">
                Siguiente
            </button>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.search-box {
    display: flex;

    button {
        position: absolute;
        top: 0px;
        right: 0px;
    }

    input {
        width: 100%;
    }

    >* {
        display: inline;
    }

    @include md {
        input {
            width: auto;
        }

        button {
            position: relative;
        }
    }
}

.wrapper {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;

    @include md {
        grid-template-columns: 1fr 1fr;
    }

    @include lg {
        grid-template-columns: 1fr 1fr 1fr;
    }
}

.wrapper>div {
    flex: 1 1 200px;
}
</style>

<script setup>
import UserCard from "@/components/UserCard.vue";
import Client from "@/helpers/client";
import { ref } from "vue";

// Tamaño de la página.
const pageSize = 21;

// Usuarios totales de la petición.
const pageUsers = ref([]);

// Término de búsqueda.
const searchTerm = ref('');

// Usuarios filtrados.
const users = ref(null);

// Usuarios totales segun el servidor.
const total = ref(0);

// Bandera para saber si se está peticionando.
const loading = ref(true);

// Página actual local.
const page = ref(0);

// Pagina de la petición.
const serverPage = ref(0);


/**
 * Filtra los usuarios de la página actual teniendo en cuenta el search term.
 * No se puede hacer un buscador por petición por que dummyapi no ofrece query params para buscar por campo.
 * 
 * @see https://dummyapi.io/docs
 * @return {Array}
 */
function getFilteredUsers() {
    if (!searchTerm.value) {
        return pageUsers.value;
    }

    const searchTermValue = searchTerm.value.toLowerCase();

    return pageUsers.value.filter(
        (user) =>
            user.firstName.toLowerCase().includes(searchTermValue)
            || user.lastName.toLowerCase().includes(searchTermValue)
    );
}

/**
 * Filtra los usuarios.
 * 
 * @return {void}
 */
function filterUsers() {
    users.value = getFilteredUsers(users.value);
}

/**
 * Petición inicial
 * 
 * @return {Promise<void>}
 */
async function fetchUsers() {
    loading.value = true;

    try {
        const { data } = await Client.get('https://dummyapi.io/data/v1/user', {
            limit: pageSize,
            page: page.value,
            firstName: "sara"
        });

        pageUsers.value = data.data;
        total.value = data.total;
        users.value = getFilteredUsers();
        serverPage.value = data.page;
        loading.value = false;
    } catch (error) {
        alert('Something went wrong');
    }

    loading.value = false;
}

/**
 * Mueve el cursor a la página siguiente y peticiona.
 * 
 * @return {void}
 */
function nextPage() {
    searchTerm.value = null;

    if (loading.value == true) {
        return;
    }

    page.value++;

    fetchUsers();
}

/**
 * Mueve el cursor a la página anterior y peticiona.
 * 
 * @return {void}
 */
function prevPage() {
    searchTerm.value = null;

    if (loading.value == true) {
        return;
    }

    page.value--;

    fetchUsers();
}

fetchUsers();

</script>