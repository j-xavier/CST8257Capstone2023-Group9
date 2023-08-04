<script setup>
import { computed } from "vue";
import { state } from "./state.js";

import Login from "./components/Login.vue";
import Navbar from "./components/Navbar.vue";
import Tasklists from "./components/Tasklists.vue";
import Tasklist from "./components/Tasklist.vue";
import CreateTasklist from "./components/CreateTasklist.vue";
import NewTask from "./components/NewTask.vue";
import EditTasklist from "./components/EditTasklist.vue";
import EditTask from "./components/EditTask.vue";
import ViewTask from "./components/ViewTask.vue";

state.token = sessionStorage.getItem("token") || "";

if (state.token) {
    state.view = "Tasklists";
}

const views = {
    Login,
    Tasklists,
    CreateTasklist,
    Tasklist,
    NewTask,
    EditTasklist,
    EditTask,
    ViewTask,
};

const currentView = computed(() => views[state.view]);
</script>

<template>
    <Navbar />

    <main class="container">
        <component :is="currentView" />
    </main>
</template>
