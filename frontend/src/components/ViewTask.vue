<script setup>

    import { state } from '../state';
    import { deleteTask } from '../api';

    const list = state.task;

function deleteConfirmation() {
    if (confirm("Are you sure you want to delete the following task?\n\n" + state.task.title + "\n\nThis action cannot be undone.")) {
        deleteTask(state.task.id);
        state.task = null;
        state.view = 'Tasklist';
    }
}
</script>

<template>

        <div class="row justify-content-between my-3">
            <div class="col-auto">
                <h2 class="m-0">{{ state.tasklist.title }}</h2>
            </div>
            <div class="col-auto">
                <button class="btn btn-danger me-3" @click="deleteConfirmation">
                    Delete Task
                </button>
                <button class="btn btn-primary me-3" @click="state.view = 'EditTask'">
                    Edit Task
                </button>
                <button class="btn btn-primary" @click="state.view = 'Tasklist'">
                    Back
                </button>
            </div>
        </div>

<table class="table">
    <tbody>
        <tr>
            <th>Task Name</th>
            <td>{{list.title}}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{list.description}}</td>
        </tr>
        <tr>
            <th>Start Date</th>
            <td>{{list.start_date}}</td>
        </tr>
        <tr>
            <th>Due Date</th>
            <td>{{list.due_date}}</td>
        </tr>
        <tr>
            <th>Priority</th>
            <td>{{list.priority_name}}</td>
        </tr>
    </tbody>
    
</table>


</template>

<style>


</style>