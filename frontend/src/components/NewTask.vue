<script setup>
import { state } from "../state.js";
import { createTask } from "../api.js";
import { reactive, ref, computed } from "vue";

const task = reactive({
    title: "",
    description: "",
    start_date: "",
    due_date: "",
    priority: "",
});

const waitingForResponse = ref(false);

async function formHandler(event) {
    if (waitingForResponse.value) {
        return;
    }

    event.target.classList.remove("was-validated");

    const dates = document.querySelectorAll("input[type=date]");
    dates.forEach((input) => {
        input.classList.remove("is-invalid");
        input.setCustomValidity("");
    });

    let validForm = true;

    if (!event.target.checkValidity()) {
        event.target.classList.add("was-validated");
        validForm = false;
    }

    if (new Date(task.start_date) >= new Date(task.due_date)) {
        event.target.classList.add("was-validated");
        dates.forEach((input) => {
            input.classList.add("is-invalid");
            input.setCustomValidity("Start date must be before due date");
        });
        validForm = false;
    }

    if (!validForm) {
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

const isInvalidStartDate = computed(() => {
    return new Date(task.start_date) >= new Date(task.due_date);
});
</script>

<template>
    <div class="row justify-content-between my-3">
        <div class="col-auto">
            <h1>Create Task</h1>
        </div>
        <div class="col-auto">
            <button class="btn btn-secondary" @click="state.view = 'Tasklist'">
                Cancel
            </button>
        </div>
    </div>

    <form @submit.prevent="formHandler" novalidate>
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
                <div class="invalid-feedback">Please enter a title</div>
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
                <div class="invalid-feedback">Please enter a description</div>
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
                <div class="invalid-feedback">
                    {{
                        isInvalidStartDate
                            ? "Start date must be before due date"
                            : "Please enter a start date"
                    }}
                </div>
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
                <div class="invalid-feedback">
                    {{
                        isInvalidStartDate
                            ? "Due date must be after start date"
                            : "Please enter a due date"
                    }}
                </div>
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
                <div class="invalid-feedback">Please select a priority</div>
            </div>
        </div>
        <button
            type="submit"
            :class="`btn btn-primary my-3 ${
                waitingForResponse ? 'disabled' : ''
            }`"
        >
            Create Task
        </button>
    </form>
</template>
