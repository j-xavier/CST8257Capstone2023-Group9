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
import Signup from "./components/Signup.vue";

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
    Signup,
};

const currentView = computed(() => views[state.view]);
</script>

<template>
    <Navbar />

    <main class="container">
        <component :is="currentView" />
    </main>
</template>

<style>
body {
    font-family: "Ubuntu", sans-serif;
}

.btn-primary {
    background-color: #ccd5ae;
    border: solid 1px #ccd5ae;
    color: black;
}

.btn-primary:hover {
    background-color: #e9edc9;
    border: solid 1px #ccd5ae;
    color: black;
}

.btn-primary.disabled {
    background-color: #83b18a;
    color: #666;
}

.btn-primary:active {
    background-color: #57755d !important;
    color: #fff !important;
}

body {
    background-color: #eef0de;
}

th {
    background-color: #eef0de !important;
}
</style>
