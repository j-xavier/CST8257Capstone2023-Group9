<script setup>
import { defineProps, defineEmits } from "vue";
import { state } from "../state.js";

const emits = defineEmits(["logout"]);
</script>

<template>
    <nav class="navbar bg-body-secondary">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Task Manager</span>
            <button
                v-if="state.token !== ''"
                class="btn btn-primary"
                @click="() => emits('logout')"
            >
                Logout
            </button>
        </div>
    </nav>
</template>
