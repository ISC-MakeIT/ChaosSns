import { csrfCookie } from "@/api";
import { API_ROUTES, apiAxios } from "@/consts/api";

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

    if (response.status === 200 && response.headers.getContentType === 'application/json') {
        const responseData = response.data;
        return responseData;
    }
    return undefined;
}
