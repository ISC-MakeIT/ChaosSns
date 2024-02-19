import { csrfCookie } from "@/api";
import { API_BASE_URL, API_ROUTES } from "@/consts/api";
import { buildURL } from "@/helpers/buildURL";

type User = {
    id: number;
    email: string;
    name: string;
    description: string;
    icon: string;
};

export const useUser = async (): Promise<User|undefined> => {
    await csrfCookie();
    const response = await fetch(
        buildURL(API_BASE_URL, API_ROUTES.GET_LOGGEDIN_USER.PATH),
        {
            method: API_ROUTES.GET_LOGGEDIN_USER.METHOD,
        }
    );
    
    if (response.status === 200 && response.headers.get('Content-Type') === 'application/json') {
        const responseData = response.json();
        return responseData;
    }
    return undefined;
}