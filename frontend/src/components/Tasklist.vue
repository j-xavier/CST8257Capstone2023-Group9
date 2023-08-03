<script setup>
import { state } from "../state";
import { tasklist } from "../api";
import { ref } from "vue";

const taskList = ref(null);

tasklist().then((response) => {
    taskList.value = response;
});
</script>

<template>
    <button class="btn btn-primary mt-2" @click="state.view = 'Tasklists'">
        Back
    </button>

    <div v-if="taskList !== null">
        <h2>{{ taskList.title }}</h2>
        <table v-if="taskList.tasks.length" class="table table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="task in taskList.tasks" :key="task.id">
                    <td>{{ task.title }}</td>
                    <td>{{ task.description }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <h1 v-else>Loading...</h1>
</template>
