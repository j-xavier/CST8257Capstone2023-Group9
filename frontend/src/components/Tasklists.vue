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
</script>

<template>
    <button class="btn btn-primary mt-2" @click="state.view = 'CreateTasklist'">
        Create Tasklist
    </button>

    <div v-if="taskLists !== null">
        <h2>Your Tasklists</h2>
        <table v-if="taskLists.length" class="table table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Tasks</th>
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
