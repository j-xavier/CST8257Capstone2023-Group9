<script setup>
import { reactive, ref } from "vue";
import { createTasklist } from "../api.js";
import { state } from "../state.js";

const list = reactive({
    title: "",
    color: "red",
});

const waitingForResponse = ref(false);

async function formHandler(event) {
    if (waitingForResponse.value) {
        return;
    }

    if (!event.target.checkValidity()) {
        event.target.classList.add("was-validated");
        return;
    }

    waitingForResponse.value = true;
    const response = await createTasklist(list);
    waitingForResponse.value = false;

    if (response) {
        state.view = "Tasklists";
    } else {
        alert("Failed to create tasklist");
    }
}
</script>

<template>
    <form @submit.prevent="formHandler" novalidate>
        <div class="d-flex flex-column align-items-center">
            <h1>Create Tasklist</h1>
            <div>
                <div class="form-group my-3">
                    <label for="title">Tasklist Name: </label>
                    <input
                        type="text"
                        class="form-control"
                        id="title"
                        v-model="list.title"
                        required
                    />
                    <div class="invalid-feedback">Name is required</div>
                </div>
                <div class="form-group my-3">
                    <label for="color">Color: </label>
                    <select
                        id="color"
                        v-model="list.color"
                        class="form-control"
                        required
                    >
                        <option value="red">Red</option>
                        <option value="blue">Blue</option>
                        <option value="green">Green</option>
                        <option value="yellow">Yellow</option>
                    </select>
                    <div class="invalid-feedback">Color is required</div>
                </div>
            </div>

            <div>
                <button
                    :class="`btn btn-primary ${
                        waitingForResponse ? 'disabled' : ''
                    }`"
                    type="submit"
                >
                    Create
                </button>

                <button
                    class="btn btn-secondary ms-3"
                    type="button"
                    @click="() => (state.view = 'Tasklists')"
                >
                    Cancel
                </button>
            </div>
        </div>
    </form>
</template>
