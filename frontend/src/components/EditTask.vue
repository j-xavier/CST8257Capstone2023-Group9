<script setup>
import { state } from "../state";
import { reactive } from "vue";
import { updateTask } from "../api";

const list = reactive({
    title: state.task.title,
    description: state.task.description,
    start_date: state.task.start_date,
    due_date: state.task.due_date,
    priority_id: state.task.priority.id,
    id: state.task.id,
});

async function handleEditTask(event) {
    event.target.classList.remove("was-validated");

    const dates = document.querySelectorAll("input[type=date]");
    dates.forEach((input) => {
        input.classList.remove("is-invalid");
        input.setCustomValidity("");
    });

    if (!event.target.checkValidity()) {
        event.target.classList.add("was-validated");
        return;
    }

    if (new Date(task.start_date) >= new Date(task.due_date)) {
        event.target.classList.add("was-validated");
        dates.forEach((input) => {
            input.classList.add("is-invalid");
            input.setCustomValidity("Start date must be before due date");
        });
        return;
    }

    const response = await updateTask(list);

    if (response) {
        state.task = list;
        state.view = "Tasklist";
    } else {
        alert("Failed to create task");
    }
    // const response = await updateTask(list);

    // if (response) {
    //     state.task = list;
    //     state.view = 'Tasklist';
    // } else {
    //     alert('Failed to create task');
    // }
}
</script>

<template>
    <div class="row my-3 justify-content-between align-items-center">
        <div class="col-auto">
            <h1>Edit Task</h1>
        </div>
    </div>
    <form @submit.prevent="handleEditTask" novalidate>
        <div>
            <label for="title">Task Name:</label>
            <input
                name="title"
                type="text"
                class="form-control"
                v-model="list.title"
                required
            />
            <div class="invalid-feedback">Title is required</div>
        </div>
        <div>
            <label for="description">Description:</label>
            <input
                name="description"
                type="text"
                class="form-control"
                v-model="list.description"
                required
            />
            <div class="invalid-feedback">Description is required</div>
        </div>
        <div>
            <label for="start_date">Start Date:</label>
            <input
                name="start_date"
                type="date"
                class="form-control"
                v-model="list.start_date"
                required
            />
            <div class="invalid-feedback">Start date is required</div>
        </div>
        <div>
            <label for="due_date">Due Date:</label>
            <input
                name="due_date"
                type="date"
                class="form-control"
                v-model="list.due_date"
                required
            />
            <div class="invalid-feedback">Due date is required</div>
        </div>
        <div>
            <label for="priority_id">Priority:</label>
            <select
                name="priority_id"
                class="form-control"
                v-model="list.priority_id"
                required
            >
                <option value="1">Low</option>
                <option value="2">Medium</option>
                <option value="3">High</option>
            </select>
            <div class="invalid-feedback">Priority is required</div>
        </div>
        <div class="my-3 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary me-3">
                Update Task
            </button>
            <button class="btn btn-secondary" @click="state.view = 'Tasklist'">
                Cancel
            </button>
        </div>
    </form>
</template>
