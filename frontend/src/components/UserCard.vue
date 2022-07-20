<template>
    <a class="user-card" v-on:click="navigateToUserView">
        <img class="mr-10" :src="user.picture" />
        <span>{{ user.firstName }} {{ user.lastName }}</span>
        <span class="caret">▶</span>
    </a>
</template>

<script setup>
import router from "@/router";
import { useStore } from "vuex";
import { defineProps, toRefs } from "vue";

const store = useStore();


const props = defineProps({
    user: Object,
});

const { user } = toRefs(props);

function navigateToUserView() {
    store.dispatch('setUser', user);

    router.push({ name: 'users.profile', params: { id: user.value.id } });
}
</script>

<style lang="scss" scoped>
.user-card {
    border-radius: $default-radius;
    border: 1px solid $default-border-color;
    padding: 10px;
    text-align: left;
    display: flex;
    align-items: center;
    cursor: pointer;
    transition: box-shadow 0.1s ease-in-out;
    text-decoration: none;
    font-size: 13px;
    color: black;

    &:hover {
        box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.021);
        border-color: darken($default-border-color, 10);
    }

    img {
        border-radius: 50%;
        width: 40px;
        height: 40px;
    }

    .caret {
        margin-left: auto;
        color: rgb(148, 148, 148);
        font-weight: bold;
        font-size: 15px;
        margin-right: 10px;
    }
}
</style>