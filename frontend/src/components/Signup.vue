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

async function formHandler(event) {
    if (waitingForResponse.value) {
        return;
    }

    document.forms[0].password_confirmation.setCustomValidity("");

    if (!event.target.checkValidity()) {
        event.target.classList.add("was-validated");
        return;
    }

    if (
        document.forms[0].password.value !==
        document.forms[0].password_confirmation.value
    ) {
        event.target.classList.add("was-validated");
        document.forms[0].password_confirmation.setCustomValidity("invalid");
        return;
    }

    waitingForResponse.value = true;
    const response = await register(user);
    waitingForResponse.value = false;

    if (response) {
        alert("User created successfully");
        console.log("test");
        state.view = "Login";
    } else {
        alert("Failed to create user");
    }
}
</script>

<template>
    <form @submit.prevent="formHandler" novalidate>
        <div class="d-flex flex-column align-items-center">
            <h1>Sign Up</h1>
            <div class="mb-3">
                <label for="name" class="form-label">Name: </label>
                <input
                    class="form-control"
                    type="text"
                    id="name"
                    v-model="user.name"
                    required
                />
                <div class="invalid-feedback">Name is required</div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email: </label>
                <input
                    class="form-control"
                    type="email"
                    id="email"
                    v-model="user.email"
                    required
                />
                <div class="invalid-feedback">Valid email is required</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password: </label>
                <input
                    class="form-control"
                    type="password"
                    id="password"
                    v-model="user.password"
                    required
                    minlength="5"
                />
                <div class="invalid-feedback">
                    Password must be at least 5 characters
                </div>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label"
                    >Confirm Password:
                </label>
                <input
                    class="form-control"
                    type="password"
                    id="password_confirmation"
                    v-model="user.password_confirmation"
                    required
                    minlength="5"
                />
                <div class="invalid-feedback">Passwords must match</div>
            </div>
            <div>
                <button
                    type="submit"
                    :class="`btn btn-primary my-3 ${
                        waitingForResponse ? 'disabled' : ''
                    }`"
                >
                    Sign Up
                </button>
                <button
                    type="button"
                    class="btn btn-secondary my-3 ms-3"
                    @click="state.view = 'Login'"
                >
                    Cancel
                </button>
            </div>
        </div>
    </form>
</template>
