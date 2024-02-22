import { csrfCookie } from "@/api";
import { API_BASE_URL, API_ROUTES, apiAxios } from "@/consts/api";
import { buildURL } from "@/helpers/buildURL";
import axios from "axios";

export type User = {
    id: number;
    email: string;
    name: string;
    description: string;
    icon: string;
};

export const useUser = async (): Promise<User | undefined> => {

    try {
        await csrfCookie();
        // const response = await fetch(
        //     buildURL(API_BASE_URL, API_ROUTES.GET_LOGGEDIN_USER.PATH),
        //     {
        //         method: API_ROUTES.GET_LOGGEDIN_USER.METHOD,
        //     }
        // );

        const response = await apiAxios.get(
            buildURL(API_BASE_URL, API_ROUTES.GET_LOGGEDIN_USER.PATH)
        )

    if (response.status === 200 && response.headers.getContentType === 'application/json') {
        const responseData = response.data;
        return responseData;
    }

    } catch (e) {
        console.log(e)
    }
    return undefined;
}
