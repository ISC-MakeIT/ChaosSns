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

export const register = async (email: string, password: string, name: string): Promise<User | undefined> => {
    await csrfCookie();

    const response = await apiAxios.post(API_ROUTES.REGISTRATION_USER.PATH, {
        email: email,
        password: password,
        icon: "バイナリデータ",
        name: name,
        description: "",
    })
    // const response = await axios(
    //     buildURL(API_BASE_URL, API_ROUTES.REGISTRATION_USER.PATH),
    //     {
    //         method: API_ROUTES.REGISTRATION_USER.METHOD,
    //         body: JSON.stringify({
    //             email: email,
    //             password: password,
    //             icon: "バイナリデータ",
    //             description: "",
    //             name: name,
    //         }),
    //         headers: {
    //             "Content-Type": "application/json",
    //         },
    //     },
    // );

    if (response.status === 200 && response.headers.getContentType === 'application/json') {
        const responseData = response.data;
        return responseData;
    }
    return undefined;
}
