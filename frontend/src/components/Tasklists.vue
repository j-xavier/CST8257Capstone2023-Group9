<script>
    import { tasklists } from "../api.js";
    const response = await tasklists(sessionStorage.getItem("token"));
    export default {
        data() {
            return {
                taskLists: response,
            };
        },
    };

</script>



<template>
    <div>
        <h2>Your Tasklists</h2>
        <ul v-if="taskLists.length">
        <li v-for="taskList in taskLists" :key="taskList.id">
            {{ taskList.title }}
        </li>
        </ul>
        <div v-else>
        No task lists found.
        </div>
    </div>
</template>