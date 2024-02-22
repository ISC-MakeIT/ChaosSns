import { API_BASE_URL, API_ROUTES, apiAxios } from "@/consts/api"
import { buildURL } from "@/helpers/buildURL"
import axios from "axios";

export const csrfCookie = async () => {
    //   return await fetch(buildURL(API_BASE_URL, API_ROUTES.CSRF_COOKIE.PATH), {
    // headers: {
    // 	'Content-Type': 'application/json'
    // },
    //       method: API_ROUTES.CSRF_COOKIE.METHOD
    //   });
    return await apiAxios.get(API_ROUTES.CSRF_COOKIE.PATH)
}
