<script setup>
import { logout } from "../api";
import { state } from "../state.js";
</script>

<template>
    <nav class="navbar bg-body-secondary">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Task Manager</span>
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
