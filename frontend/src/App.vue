<script setup>
import { ref, computed } from "vue";
import { state } from "./state.js";
import Login from "./components/Login.vue";
import Navbar from "./components/Navbar.vue";
import Tasklists from "./components/Tasklists.vue";
import CreateTasklist from "./components/CreateTasklist.vue";

state.token = sessionStorage.getItem("token") || "";

function handleLogin(newToken) {
    state.token = newToken;
    sessionStorage.setItem("token", newToken);
}

function handleLogout() {
    state.token = "";
    sessionStorage.removeItem("token");
}

function handleNewTasklist() {
    state.tasklists = tasklists(state.token);
}

</script>

<template>
    <Navbar @logout="handleLogout" />

    <main class="container">
        <Login v-if="!state.token" @login="handleLogin" />
        <div v-else>
            <h1>Logged in</h1>
            <p>Token: {{ state.token }}</p>
            <button v-if="!state.showCreateForm" @click="state.showCreateForm = !state.showCreateForm">Create Tasklist</button>
            <div v-else>
                <button @click="state.showCreateForm = !state.showCreateForm">Cancel</button>
                <CreateTasklist :token="state.token" />
            </div>
            <Tasklists v-if="state.token && !state.showCreateForm" :token="state.token" @tasklist-created="handleNewTasklist"/>
            <!-- <CreateTasklist v-if="state.token" :token="state.token" /> -->
            
        </div>
    </main>
</template>
