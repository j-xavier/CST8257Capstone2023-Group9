<script setup>
import { state } from "../state";
import { tasklist } from "../api";
import { ref, reactive } from "vue";

const taskList = ref(null);

tasklist().then((response) => {
    taskList.value = response;
});

const tableStyle = reactive({
    backgroundColor: taskList.value?.color
});

function getRowColor(index) {
    return index % 2 === 0 
        ? {backgroundColor: 'taskList.value?.color'} 
        : {backgroundColor: '#ddd'};
}

function showEditTasklist() {
    console.log(taskList.value);
    state.tasklist = taskList.value;
    state.view = "EditTasklist";
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
                    <th>Start Date</th>
                    <th>Due Date</th>
                    <th>Priority</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="task, index in taskList.tasks" :key="index" :style="getRowColor(index)">
                    <td>{{ task.title }}</td>
                    <td>{{ task.description }}</td>
                    <td>{{ task.start_date }}</td>
                    <td>{{ task.due_date }}</td>
                    <td>{{ task.priority_name }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <h1 v-else>Loading...</h1>
</template>

<style>
    td {
        background-color: inherit !important;
    }
</style>