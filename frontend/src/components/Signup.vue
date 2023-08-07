<script setup>

import { register } from "../api.js";
import { ref, reactive } from "vue";
import { state } from "../state";

const user = reactive({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const waitingForResponse = ref(false);

async function formHandler() {
    if(waitingForResponse.value) {
        return;
    }

    waitingForResponse.value = true;
    const response = await register(user);
    waitingForResponse.value = false;

    if (response) {
        alert("User created successfully");
        console.log("test");
        state.view  = "Login";
    } else {
        alert("Failed to create user");
    }
}

</script>

<template>
    <form @submit.prevent="formHandler">

        <div>
            <label for="name" class="form-label">Name: </label>
            <input
                class="form-control"
                type="text"
                id="name"
                v-model="user.name"
                placeholder="Name"
                required
            />
        </div>
        <div>
            <label for="email" class="form-label">Email: </label>
            <input
                class="form-control"
                type="email"
                id="email"
                v-model="user.email"
                placeholder="Email"
                required
            />
        </div>
        <div>
            <label for="password" class="form-label">Password: </label>
            <input
                class="form-control"
                type="password"
                id="password"
                v-model="user.password"
                placeholder="Password"
                required
            />
        </div>
        <div>
            <label for="password_confirmation" class="form-label">Confirm Password: </label>
            <input
                class="form-control"
                type="password"
                id="password_confirmation"
                v-model="user.password_confirmation"
                placeholder="Confirm Password"
                required
            />
        </div>
        <div>
            <button type="submit" :class="`btn btn-primary my-3 ${waitingForResponse ? 'disabled' : ''}` " @click="formHandler">
            Sign Up
            </button>
            <button type="button" class="btn btn-secondary my-3 ms-3" @click="state.view = 'Login'">Cancel</button>
        </div>

    </form>



</template>