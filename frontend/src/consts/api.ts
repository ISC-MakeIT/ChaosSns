import axios from "axios";

type ApiRoute = {
    PATH: string;
    METHOD: string;
};

const METHODS = {
    GET: 'GET',
    POST: 'POST',
    PUT: 'PUT',
    DELETE: 'DELETE',
} as const;

export const API_ROUTES: {[name: string]: ApiRoute} = {
    CSRF_COOKIE: {
        PATH: "/sanctum/csrf-cookie",
        METHOD: METHODS.GET,
    },
    GET_LOGGEDIN_USER: {
        PATH: "/api/users/self",
        METHOD: METHODS.GET,
    },
    REGISTRATION_USER: {
        PATH: "/api/users",
        METHOD: METHODS.POST,
    },
    LOGIN: {
        PATH: "/api/users/login",
        METHOD: METHODS.POST,
    },
    LOGOUT: {
        PATH: "/api/users/logout",
        METHOD: METHODS.POST,
    },
    UPDATE_USER: {
        PATH: '/api/users',
        METHOD: METHODS.PUT,
    },
    GET_USER: {
        PATH: '/api/users/',
        METHOD: METHODS.GET,
    },
    FOLLOW_USER: {
        PATH: '/api/users/follow/',
        METHOD: METHODS.POST,
    },
    GET_NOTIFICATIONS: {
        PATH: '/api/notifications',
        METHOD: METHODS.GET,
    }
} as const;

export const API_BASE_URL = process.env.API_BASE_URL || process.env.NEXT_PUBLIC_API_URL as string;

export const apiAxios = axios.create({
  baseURL: API_BASE_URL,
  timeout: 1000,
  withCredentials: true,
  withXSRFToken: true,
});
