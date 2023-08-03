<script>
    import { ref } from "vue";
    import { createTasklist } from "../api.js";

    export default {
        data() {
            return {
                list: {
                    title: "",
                    color: "red",
                },
            };
        },
        methods: {
            async createTasklist() {
                const {title, color} = this.list;
                const response = await createTasklist(
                    sessionStorage.getItem("token"),
                    title,
                    color
                );
                location.reload();
                
            }
        }
    };

</script>

<template>

    <!-- form for creating a new tasklist -->
    <form @submit.prevent="createTasklist">
        <label for="title">Tasklist Name: </label>
        <input
            type="text"
            id="title"
            v-model="list.title"
            placeholder="Title"
            required
        />
        <label for="color">Color: </label>
        <select id="color" v-model="list.color" required>
            <option value="red">Red</option>
            <option value="blue">Blue</option>
            <option value="green">Green</option>
            <option value="yellow">Yellow</option>
        </select>

        <button type="submit">Create Tasklist</button>
    </form>

</template>

