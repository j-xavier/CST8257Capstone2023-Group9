<script setup>
import { login } from "../api.js";
import { ref } from "vue";
import { state } from "../state.js";

const email = ref("");
const password = ref("");

const waitingForResponse = ref(false);

async function loginHandler(event) {
    // this prevents the form from being submitted if the user is already waiting for a response
    if (waitingForResponse.value) {
        return;
    }

    if (!event.target.checkValidity()) {
        event.target.classList.add("was-validated");
        return;
    }

    waitingForResponse.value = true;
    const response = await login(email.value, password.value);
    waitingForResponse.value = false;

    console.log(response);

    if (response) {
        state.token = response.token;
        sessionStorage.setItem("token", response.token);
        state.view = "Tasklists";
    } else {
        alert("Login failed");
    }
}
</script>

<template>
    <form @submit.prevent="loginHandler" novalidate>
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
                <div class="invalid-feedback">Valid email is required</div>
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
                <div class="invalid-feedback">Password is required</div>
            </div>

            <button
                type="submit"
                :class="`btn btn-primary ${
                    waitingForResponse ? 'disabled' : ''
                }`"
            >
                Login
            </button>

            <div>
                <p class="my-3">Don't have an account?</p>
            </div>
            <button class="btn btn-primary" @click="state.view = 'Signup'">
                Signup
            </button>
        </div>
    </form>
</template>
