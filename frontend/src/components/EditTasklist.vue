<script setup>
import { state } from "../state.js";
import { updateTasklist } from "../api.js";
import { reactive, ref } from "vue";

const list = reactive({
    title: state.tasklist.title,
    color: state.tasklist.color,
});

const waitingForResponse = ref(false);

async function handleEditTasklist(event) {
    if (waitingForResponse.value) {
        return;
    }

    if (!event.target.checkValidity()) {
        event.target.classList.add("was-validated");
        return;
    }

    waitingForResponse.value = true;
    const response = await updateTasklist(list);
    waitingForResponse.value = false;

    if (response) {
        state.tasklist = list;
        state.view = "Tasklist";
    } else {
        alert("Failed to create tasklist");
    }
}

function handleEditTask(task) {
    state.task = task;
    state.view = "EditTask";
}

function getRowColor(index) {
    const colors = {
        red: ["#f99", "#fcc"],
        blue: ["#99f", "#ccf"],
        green: ["#9f9", "#cfc"],
        yellow: ["#ff9", "#ffc"],
    };
    return { backgroundColor: colors[state.tasklist.color][index % 2] };
}
</script>

<template>
    <form
        class="d-flex my-3 justify-content-center"
        @submit.prevent="handleEditTasklist"
        novalidate
    >
        <div class="d-flex align-items-center">
            <label for="title">Tasklist Name:</label>
            <div class="ms-1">
                <input
                    type="text"
                    class="form-control"
                    v-model="list.title"
                    required
                    placeholder="Enter tasklist name"
                />
            </div>
        </div>

        <div class="d-flex align-items-center ms-3">
            <label for="color">Color:</label>
            <div class="ms-1">
                <select class="form-control" v-model="list.color" required>
                    <option value="red">Red</option>
                    <option value="blue">Blue</option>
                    <option value="green">Green</option>
                    <option value="yellow">Yellow</option>
                </select>
                <div class="invalid-feedback">Please select a color</div>
            </div>
        </div>

        <div class="d-flex align-items-center ms-3">
            <button
                type="submit"
                :class="`btn btn-primary ${
                    waitingForResponse ? 'disabled' : ''
                }`"
            >
                Update Tasklist
            </button>
            <button
                :class="`btn btn-secondary ms-1 ${
                    waitingForResponse ? 'disabled' : ''
                }`"
                @click="state.view = 'Tasklist'"
            >
                Cancel
            </button>
        </div>
    </form>

    <table v-if="state.tasklist.tasks.length" class="table table-hover">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>Due Date</th>
                <th>Priority</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <tr
                v-for="(task, index) in state.tasklist.tasks"
                :key="index"
                :style="getRowColor(index)"
            >
                <td>{{ task.title }}</td>
                <td>{{ task.description }}</td>
                <td>{{ task.start_date }}</td>
                <td>{{ task.due_date }}</td>
                <td>{{ task.priority_name }}</td>
                <td>
                    <span
                        class="material-symbols-outlined"
                        @click="handleEditTask(task)"
                        >edit_square</span
                    >
                </td>
            </tr>
        </tbody>
    </table>
</template>
