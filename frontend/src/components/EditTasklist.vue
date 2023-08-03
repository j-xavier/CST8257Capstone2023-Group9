<script setup>
import { state } from "../state.js";
import { updateTask } from "../api.js";
import { reactive } from "vue";

const list = reactive({
    title: state.tasklist.title,
    color: state.tasklist.color,
});
</script>

<template>
    <form class="d-flex">
        <div class="d-flex align-items-center">
            <label for="title">Tasklist Name:</label>
            <div>
                <input type="text" class="form-control" v-model="list.title" />
            </div>
            
        </div>

        <div class="d-flex align-items-center">
            <label for="color">Color:</label>
            <div>
                <select class="form-control" v-model="list.color">
                <option value="red">Red</option>
                <option value="blue">Blue</option>
                <option value="green">Green</option>
                <option value="yellow">Yellow</option>
            </select>
            </div>
        </div>

        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary">
                Update Tasklist
            </button>
            <button class="btn btn-secondary" @click="state.view = 'Tasklist'">Cancel</button>
        </div>
    </form>



    <table v-if="state.tasklist.tasks.length" class="table table-hover">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>Due Date</th>
                <th>Priority</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(task, index) in state.tasklist.tasks" :key="index">
                <td>{{ task.title }}</td>
                <td>{{ task.description }}</td>
                <td>{{ task.start_date }}</td>
                <td>{{ task.due_date }}</td>
                <td>{{ task.priority_name }}</td>
                <td><p class="fa-solid fa-pen-to-square" @click="state.view='EditTask'">Edit</p></td>
            </tr>
        </tbody>
    </table>
</template>
