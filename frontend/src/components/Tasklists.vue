<script setup>
import { tasklists } from "../api.js";
import { state } from "../state.js";
import { ref } from "vue";

const taskLists = ref(null);
tasklists(sessionStorage.getItem("token")).then((response) => {
    taskLists.value = response;
});

function openTasklist(tasklist) {
    state.view = "Tasklist";
    state.tasklistId = tasklist.id;
}

function sortByTitle() {
    taskLists.value.sort((a, b) => {
        if (a.title < b.title) {
            return -1;
        } else if (a.title > b.title) {
            return 1;
        } else {
            return 0;
        }
    });
}

function sortByTasks() {
    taskLists.value.sort((a, b) => {
        if (a.tasks_count < b.tasks_count) {
            return -1;
        } else if (a.tasks_count > b.tasks_count) {
            return 1;
        } else {
            return 0;
        }
    });
}

</script>

<template>
    <div v-if="taskLists !== null">
        <div class="row justify-content-between my-3">
            <div class="col-auto">
                <h2 class="m-0">Your Tasklists</h2>
            </div>
            <div class="col-auto">
                <button
                    class="btn btn-primary"
                    @click="state.view = 'CreateTasklist'"
                >
                    Create Tasklist
                </button>
            </div>
        </div>

        <table v-if="taskLists.length" class="table table-hover">
            <thead>
                <tr>
                    <th @click="sortByTitle" style="cursor: pointer">Title</th>
                    <th @click="sortByTasks" style="cursor: pointer">Tasks</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    @click="openTasklist(taskList)"
                    v-for="taskList in taskLists"
                    :key="taskList.id"
                >
                    <td>{{ taskList.title }}</td>
                    <td>{{ taskList.tasks_count }}</td>
                </tr>
            </tbody>
            
        </table>
        <div v-else>No task lists found.</div>
    </div>
    <div v-else>
        <h2>Loading...</h2>
    </div>
</template>

<style>
tbody tr {
    cursor: pointer;
}
</style>


