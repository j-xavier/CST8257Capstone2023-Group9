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
    <div class="row justify-content-between my-3">
            <div class="col-auto">
                <h2 class="m-0">Create Tasklist</h2>
            </div>
            <div class="col-auto">
                <button
                    class="btn btn-primary"
                    @click="state.view = 'Tasklists'"
                >
                    Cancel
                </button>
            </div>
    </div>
    
    <div>
        <form @submit.prevent="formHandler">
            <div class="form-group my-3">
                <label for="title">Tasklist Name: </label>
                <input
                    type="text"
                    class="form-control"
                    id="title"
                    v-model="list.title"
                    placeholder="Title"
                    required
                />
            </div>
            <div class="form-group my-3">
                <label for="color">Color: </label>
                <select id="color" v-model="list.color" class="form-control" required>
                    <option value="red">Red</option>
                    <option value="blue">Blue</option>
                    <option value="green">Green</option>
                    <option value="yellow">Yellow</option>
                </select>
            </div>
            <div>
                <button class="btn btn-primary " type="submit">Create Tasklist</button>
            </div>
                            
        </form>
    </div>
    
</template>
