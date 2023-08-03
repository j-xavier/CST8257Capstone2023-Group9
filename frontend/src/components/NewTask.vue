<script setup>
import { state } from "../state.js";
import { createTask } from "../api.js";
import { reactive, ref } from "vue";

const task = reactive({
    title: "",
    description: "",
    start_date: "",
    due_date: "",
    priority: "",
});

const waitingForResponse = ref(false);

async function formHandler() {
    if(waitingForResponse.value) {
        return;
    }

    waitingForResponse.value = true;
    const response = await createTask(task);
    waitingForResponse.value = false;

    if (response) {
        state.view = "Tasklist";
    } else {
        alert("Failed to create tasklist");
    }
}
</script>

<template>
    <form @submit.prevent="formHandler">
        <div>
            <div>
                <label for="title" class="form-label">Task Name: </label>
                <input
                    class="form-control"
                    type="text"
                    id="title"
                    v-model="task.title"
                    placeholder="Title"
                    required
                />
            </div>
            <div>
                <label for="description" class="form-label"
                    >Description:
                </label>
                <input
                    class="form-control"
                    type="text"
                    id="description"
                    v-model="task.description"
                    placeholder="Description"
                    required
                />
            </div>
            <div>
                <label for="start_date" class="form-label">Start Date: </label>
                <input
                    class="form-control"
                    type="date"
                    id="start_date"
                    v-model="task.start_date"
                    placeholder="Start Date"
                    required
                />
            </div>

            <div>
                <label for="due_date" class="form-label">Due Date: </label>
                <input
                    class="form-control"
                    type="date"
                    id="due_date"
                    v-model="task.due_date"
                    placeholder="Due Date"
                    required
                />
            </div>

            <div>
                <label for="priority" class="form-label">Priority: </label>
                <select
                    id="priority"
                    class="form-control"
                    v-model="task.priority"
                    required
                >
                    <option value="1">Low</option>
                    <option value="2">Medium</option>
                    <option value="3">High</option>
                </select>
            </div>
        </div>
        <button type="submit" :class="`btn btn-primary my-3 ${waitingForResponse ? 'disabled' : ''}`">Create Task</button>
    </form>
</template>
