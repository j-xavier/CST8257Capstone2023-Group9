<script setup>
import { state } from "../state";
import { tasklist } from "../api";
import { ref, reactive } from "vue";

const taskList = ref(null);

tasklist().then((response) => {
    taskList.value = response;
});

const tableStyle = reactive({
    backgroundColor: taskList.value?.color,
});

function getRowColor(index) {
    const colors = {
        red: ["#f99", "#fcc"],
        blue: ["#99f", "#ccf"],
        green: ["#9f9", "#cfc"],
        yellow: ["#ff9", "#ffc"],
    };
    return { backgroundColor: colors[taskList.value?.color][index % 2] };
}

function showEditTasklist() {
    state.tasklist = taskList.value;
    state.view = "EditTasklist";
}

function seeTask(task, taskList) {
    state.task = task;
    state.tasklist = taskList;
    state.view = "ViewTask";
}

function sortByName() {
    taskList.value.tasks.sort((a, b) => {
        if (a.title < b.title) {
            return -1;
        } else if (a.title > b.title) {
            return 1;
        } else {
            return 0;
        }
    });
}

function sortByStartDate() {
    taskList.value.tasks.sort((a, b) => {
        if (a.start_date < b.start_date) {
            return -1;
        } else if (a.start_date > b.start_date) {
            return 1;
        } else {
            return 0;
        }
    });
}

function sortByDueDate() {
    taskList.value.tasks.sort((a, b) => {
        if (a.due_date < b.due_date) {
            return -1;
        } else if (a.due_date > b.due_date) {
            return 1;
        } else {
            return 0;
        }
    });
}

function sortByPriority() {
    taskList.value.tasks.sort((a, b) => {
        if (a.priority_id < b.priority_id) {
            return 1;
        } else if (a.priority_id > b.priority_id) {
            return -1;
        } else {
            return 0;
        }
    });
}
</script>

<template>
    <div v-if="taskList">
        <div class="row justify-content-between my-3">
            <div class="col-auto">
                <h2 class="m-0">{{ taskList.title }}</h2>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary me-3" @click="showEditTasklist">
                    Edit Tasklist
                </button>
                <button
                    class="btn btn-primary me-3"
                    @click="state.view = 'NewTask'"
                >
                    New task
                </button>
                <button
                    class="btn btn-primary"
                    @click="state.view = 'Tasklists'"
                >
                    Back
                </button>
            </div>
        </div>

        <table v-if="taskList.tasks.length" class="table table-hover">
            <thead>
                <tr>
                    <th @click="sortByName" style="cursor: pointer;">Task Name</th>
                    <th>Description</th>
                    <th @click="sortByStartDate" style="cursor: pointer;">Start Date</th>
                    <th @click="sortByDueDate" style="cursor: pointer;">Due Date</th>
                    <th @click="sortByPriority" style="cursor: pointer;">Priority</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(task, index) in taskList.tasks"
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
                            @click="seeTask(task, taskList)"
                            >search</span
                        >
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <h1 v-else>Loading...</h1>
</template>

<style>
td {
    background-color: inherit !important;
    cursor: default;
}
td:nth-child(6):hover {
    cursor: pointer;
}
</style>
