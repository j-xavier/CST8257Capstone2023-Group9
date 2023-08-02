<script setup>
import { ref, computed } from "vue";
import { state } from "./state.js";
import Login from "./components/Login.vue";
import Navbar from "./components/Navbar.vue";

state.token = sessionStorage.getItem("token") || "";

function handleLogin(newToken) {
    state.token = newToken;
    sessionStorage.setItem("token", newToken);
}

function handleLogout() {
    state.token = "";
    sessionStorage.removeItem("token");
}
</script>

<template>
    <Navbar @logout="handleLogout" />

    <main class="container">
        <Login v-if="!state.token" @login="handleLogin" />
        <div v-else>
            <h1>Logged in</h1>
            <p>Token: {{ state.token }}</p>
        </div>
    </main>
</template>
