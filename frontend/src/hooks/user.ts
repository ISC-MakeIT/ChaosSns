import { csrfCookie } from "@/api";
import {API_ROUTES, apiAxios } from "@/consts/api";

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

        const response = await apiAxios.get(API_ROUTES.GET_LOGGEDIN_USER.PATH)

        if (response.status === 200 && response.headers.getContentType === 'application/json') {
            const responseData = response.data;
            return responseData;
        }

    } catch (e) {
        console.log(e)
    }
    return undefined;
}
