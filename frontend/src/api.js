//import axios from node modules
import axios from "axios";
import { state } from "./state";

//create a new axios instance
const api = axios.create({
    baseURL: "http://localhost:8000",
    timeout: 10000,
    responseType: "json",
});

// sample api method
export const login = async (email, password) => {
    try {
        const response = await api({
            method: "post",
            url: "/login",
            data: { email, password },
        });

        return response.data;
    } catch (error) {
        console.log(error);
    }
};

export const logout = () => {
    try {
        api({
            method: "post",
            url: "/logout",
            headers: { Authorization: `Bearer ${state.token}` },
        });

        state.token = "";
        sessionStorage.removeItem("token");
        state.view = "Login";
    } catch (error) {
        console.log(error);
    }
};

export const tasklists = async () => {
    try {
        const response = await api({
            method: "get",
            url: "/api/tasklists",
            headers: { Authorization: `Bearer ${state.token}` },
        });
        state.tasklists = response.data;
        return response.data;
    } catch (error) {
        console.log(error);
    }
};

export const createTasklist = async (list) => {
    try {
        const response = await api({
            method: "post",
            url: "/api/tasklists",
            headers: { Authorization: `Bearer ${state.token}` },
            data: {
                title: list.title,
                color: list.color,
            },
        });

        if (response.status === 201) {
            return response.data;
        }
    } catch (error) {
        console.log(error);
    }
};

export const tasklist = async () => {
    try {
        const response = await api({
            method: "get",
            url: `/api/tasklists/${state.tasklistId}`,
            headers: { Authorization: `Bearer ${state.token}` },
        });

        if (response.status === 200) {
            return response.data;
        }
    } catch (error) {
        console.log(error);
    }
};

export const createTask = async (task) => {
    try {
        const response = await api({
            method: "post",
            url: `/api/tasklists/${state.tasklistId}/tasks`,
            headers: { Authorization: `Bearer ${state.token}` },
            data: {
                title: task.title,
                description: task.description,
                start_date: task.start_date,
                due_date: task.due_date,
                priority_id: task.priority,
            },
        });
        if (response.status === 201) {
            return response.data;
        }
    } catch (error) {
        console.log(error);
    }
};

export const updateTasklist = async (list) => {
    try {
        const response = await api({
            method: "put",
            url: `/api/tasklists/${state.tasklistId}`,
            headers: { Authorization: `Bearer ${state.token}` },
            data: {
                title: list.title,
                color: list.color,
            },
        });

        if (response.status === 200) {
            return response.data;
        }
    } catch (error) {
        console.log(error);
    }
};

export const updateTask = async (list) => {
    try {
        const response = await api({
            method: "put",
            url: `/api/tasklists/${state.tasklistId}/tasks/${list.id}`,
            headers: { Authorization: `Bearer ${state.token}` },
            data: {
                title: list.title,
                description: list.description,
                start_date: list.start_date,
                due_date: list.due_date,
                priority_id: list.priority_id,
            },
        });

        if (response.status === 200) {
            return response.data;
        }
    } catch (error) {
        console.log(error);
    }
};

export const viewTask = async (id) => {
    try {
        const response = await api({
            method: "get",
            url: `/api/tasklists/${state.tasklistId}/tasks/${id}`,
            headers: { Authorization: `Bearer ${state.token}` },
        });

        if (response.status === 200) {
            return response.data;
        }
    } catch (error) {
        console.log(error);
    }
};

export const deleteTask = async (id) => {
    try {
        const response = await api({
            method: "delete",
            url: `/api/tasklists/${state.tasklistId}/tasks/${id}`,
            headers: { Authorization: `Bearer ${state.token}` },
        });

        if (response.status === 200) {
            return response.data;
        }
    } catch (error) {
        console.log(error);
    }

    return null;

};

export const deleteTasklist = async (id) => {
    try {
        const response = await api({
            method: "delete",
            url: `/api/tasklists/${id}`,
            headers: { Authorization: `Bearer ${state.token}` },
        });

        if (response.status === 200) {
            return response.data;
        }
    } catch (error) {
        console.log(error);
    }

};


//export all methods
export default {
    login,
    logout,
    tasklists,
    createTasklist,
    createTask,
    updateTasklist,
    updateTask,
    viewTask,
    deleteTask,
    deleteTasklist,
};
