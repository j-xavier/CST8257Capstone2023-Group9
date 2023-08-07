<script setup>
import { login } from "../api.js";
import { ref } from "vue";
import { state } from "../state.js";

const email = ref("");
const password = ref("");

const waitingForResponse = ref(false);

async function loginHandler() {
    // this prevents the form from being submitted if the user is already waiting for a response
    if (waitingForResponse.value) {
        return;
    }
    waitingForResponse.value = true;
    const response = await login(email.value, password.value);
    waitingForResponse.value = false;

    if (response.token) {
        state.token = response.token;
        sessionStorage.setItem("token", response.token);
        state.view = "Tasklists";
    } else {
        alert("Login failed");
    }
}
</script>

<template>
    <form @submit.prevent="loginHandler">
        <div class="d-flex flex-column align-items-center">
            <h1>Login</h1>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    v-model="email"
                    class="form-control"
                    required
                />
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    v-model="password"
                    class="form-control"
                    required
                />
            </div>

            <button
                type="submit"
                :class="`btn btn-primary ${
                    waitingForResponse ? 'disabled' : ''
                }`"
            >
                Login
            </button>
        </div>
    </form>
    <div>
        <p>Don't have an account?</p>
        <button class="btn btn-primary" @click="state.view = 'Signup'">
            Signup
        </button>
    </div>
</template>
