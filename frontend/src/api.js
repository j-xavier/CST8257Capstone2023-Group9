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

export const logout = async (token) => {
    try {
        const response = await api({
            method: "post",
            url: "/logout",
            headers: { Authorization: `Bearer ${token}` },
        });

        return response.data;
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

//export all methods
export default {
    login,
    logout,
    tasklists,
    createTasklist,
};
