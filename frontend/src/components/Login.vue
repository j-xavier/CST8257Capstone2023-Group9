<script setup>
import { login } from "../api.js";
import { ref, defineEmits } from "vue";

const emit = defineEmits(["login"]);

const email = ref("");
const password = ref("");

const waitingForResponse = ref(false);

async function loginHandler(e) {
    e.preventDefault();

    if (waitingForResponse.value) {
        return;
    }

    waitingForResponse.value = true;
    const response = await login(email.value, password.value);
    waitingForResponse.value = false;

    if (response.token) {
        emit("login", response.token);
    }
}
</script>

<template>
    <form @submit="loginHandler">
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
</template>
