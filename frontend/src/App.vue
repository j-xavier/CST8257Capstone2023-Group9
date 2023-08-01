<script setup>
import { ref } from "vue";
import Login from "./components/Login.vue";

const token = ref(null);

function handleLogin(newToken) {
    token.value = newToken;
}
</script>

<template>
    <main class="container">
        <Login v-if="!token" @login="handleLogin" />
        <div v-else>
            <h1>Logged in</h1>
            <p>Token: {{ token }}</p>
        </div>
    </main>
</template>
