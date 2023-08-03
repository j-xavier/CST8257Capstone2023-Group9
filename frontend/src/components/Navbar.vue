<script setup>
import { state } from "../state.js";

function handleLogout() {
    state.token = "";
    sessionStorage.removeItem("token");
    state.view = "Login";
}
</script>

<template>
    <nav class="navbar bg-body-secondary">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Task Manager</span>
            <button
                v-if="state.token !== ''"
                class="btn btn-primary"
                @click="handleLogout"
            >
                Logout
            </button>
        </div>
    </nav>
</template>
