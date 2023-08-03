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
    

    <div v-if="taskList">
        <div class="row justify-content-between my-3">
            <div class="col-auto">
                <h2 class="m-0">{{ taskList.title }}</h2>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary me-3" @click="state.view = 'NewTask'">
                    New task
                </button>
                <button class="btn btn-primary" @click="state.view = 'Tasklists'">
                    Back
                </button>
            </div>
        </div>
        
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
