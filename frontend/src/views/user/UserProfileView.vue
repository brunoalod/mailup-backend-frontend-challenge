<template>
    <div class="container">
        <div v-if="$store.state.user == null">No hay información para mostrar.
            <div class="right">
                <button type="button" class="btn" v-on:click="$router.push({ name: 'users.index' })">Volver</button>
            </div>
        </div>
        <div v-else>
            <div style="display: flex;justify-content: space-between;">
                <div>
                    <img class="mr-10" :src="$store.state.user.picture" />
                    <span>{{ $store.state.user.firstName }} {{ $store.state.user.lastName }}</span>
                </div>
                <div>
                    <button type="button" class="btn" v-on:click="$router.push({ name: 'users.index' })">Volver</button>
                </div>
            </div>
            <p v-for="(value, property) in $store.state.user" v-bind:key="value">
                {{ property }}: {{ value }}
            </p>
        </div>
    </div>
</template>

<style scoped>
.container {
    text-align: left;
}

img {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    vertical-align: middle;
}

.right {
    display: flex;
    justify-content: flex-end;
}
</style>

<script setup>
</script>