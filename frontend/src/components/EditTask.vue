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

async function handleEditTask() {
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
    <form @submit.prevent="handleEditTask">
        <div>
            <label for="title">Task Name:</label>
            <div>
                <input
                    name="title"
                    type="text"
                    class="form-control"
                    v-model="list.title"
                />
            </div>
        </div>
        <div>
            <label for="description">Description:</label>
            <div>
                <input
                    name="description"
                    type="text"
                    class="form-control"
                    v-model="list.description"
                />
            </div>
        </div>
        <div>
            <label for="start_date">Start Date:</label>
            <div>
                <input
                    name="start_date"
                    type="date"
                    class="form-control"
                    v-model="list.start_date"
                />
            </div>
        </div>
        <div>
            <label for="due_date">Due Date:</label>
            <div>
                <input
                    name="due_date"
                    type="date"
                    class="form-control"
                    v-model="list.due_date"
                />
            </div>
        </div>
        <div>
            <label for="priority_id">Priority:</label>
            <div>
                <select
                    name="priority_id"
                    class="form-control"
                    v-model="list.priority_id"
                >
                    <option value="1">Low</option>
                    <option value="2">Medium</option>
                    <option value="3">High</option>
                </select>
            </div>
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