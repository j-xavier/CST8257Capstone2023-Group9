import { reactive } from "vue";

export const state = reactive({
    token: "",
    view: "Login",
    tasklistId: null,
    tasklist: null,
    task: null,
    tasklists: [],
});
