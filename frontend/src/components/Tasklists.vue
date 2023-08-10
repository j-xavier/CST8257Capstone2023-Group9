<script setup>
import { tasklists, deleteTasklist } from "../api.js";
import { state } from "../state.js";
import { ref } from "vue";

const taskLists = ref(null);

function getTasklists() {
    tasklists(sessionStorage.getItem("token")).then((response) => {
        taskLists.value = response;
    });
}

getTasklists();

function openTasklist(tasklist) {
    state.view = "Tasklist";
    state.tasklistId = tasklist.id;
}

function sortByTitle() {
    taskLists.value.sort((a, b) => {
        if (a.title.toLowerCase() < b.title.toLowerCase()) {
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

function deleteConfirmation(tasklistToDelete) {
    if (
        confirm(
            "Are you sure you want to delete the following tasklist?\n\n" +
                tasklistToDelete.title +
                "\n\nThis action cannot be undone."
        )
    ) {
        deleteTasklist(tasklistToDelete.id);
        taskLists.value = null;
        getTasklists();
        // tasklist().then((response) => {
        //     taskList.value = response;
        // });
        //console.log(tasklistToDelete);
    }
}

function getRowColor(color) {
    const colors = {
        red: "#fcc",
        blue: "#ccf",
        green: "#cfc",
        yellow: "#ffc",
    };
    return { backgroundColor: colors[color] };
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
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="taskList in taskLists"
                    :key="taskList.id"
                    :style="getRowColor(taskList.color)"
                >
                    <td @click="openTasklist(taskList)" style="cursor: pointer">
                        {{ taskList.title }}
                    </td>
                    <td @click="openTasklist(taskList)" style="cursor: pointer">
                        {{ taskList.tasks_count }}
                    </td>
                    <td>
                        <span
                            class="material-symbols-outlined"
                            @click="deleteConfirmation(taskList)"
                            >delete</span
                        >
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-else>No task lists found.</div>
    </div>
    <div v-else>
        <h1>Loading...</h1>
    </div>
</template>

<style>
tbody tr {
    cursor: pointer;
}
</style>
