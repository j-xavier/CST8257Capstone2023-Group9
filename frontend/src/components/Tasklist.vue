<script setup>
import { state } from "../state";
</script>

<template>
    <button class="btn btn-primary mt-2" @click="state.view = 'Tasklists'">
        Back
    </button>
    <h1>VIEW FOR TASKLIST ID = {{ state.tasklistId }}</h1>
</template>
