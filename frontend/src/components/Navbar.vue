<script setup>
import { logout } from "../api";
import { state } from "../state.js";

function goToHome() {
    if (state.token !== "") state.view = "Tasklists";
    else state.view = "Login";
}
</script>

<template>
    <nav class="navbar">
        <div class="container">
            <span
                class="navbar-brand mb-0 h1"
                @click="goToHome"
                style="cursor: pointer"
                >Task Manager</span
            >
            <button
                v-if="state.token !== ''"
                class="btn btn-primary"
                @click="logout"
            >
                Logout
            </button>
        </div>
    </nav>
</template>

<style scoped>
nav {
    background-color: #354f52;
}

.navbar-brand {
    color: #fff;
}
</style>
