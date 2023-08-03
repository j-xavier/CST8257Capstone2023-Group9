<script setup>
import { reactive } from "vue";
import { createTasklist } from "../api.js";
import { state } from "../state.js";

const list = reactive({
    title: "",
    color: "red",
});

async function formHandler() {
    const response = await createTasklist(list);

    if (response) {
        state.view = "Tasklists";
    } else {
        alert("Failed to create tasklist");
    }
}
</script>

<template>
    <button @click="state.view = 'Tasklists'">Cancel</button>
    <!-- form for creating a new tasklist -->
    <form @submit.prevent="formHandler">
        <label for="title">Tasklist Name: </label>
        <input
            type="text"
            id="title"
            v-model="list.title"
            placeholder="Title"
            required
        />
        <label for="color">Color: </label>
        <select id="color" v-model="list.color" required>
            <option value="red">Red</option>
            <option value="blue">Blue</option>
            <option value="green">Green</option>
            <option value="yellow">Yellow</option>
        </select>

        <button type="submit">Create Tasklist</button>
    </form>
</template>
