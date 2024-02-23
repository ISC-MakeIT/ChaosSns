
import { csrfCookie } from "@/api";
import { API_ROUTES, apiAxios } from "@/consts/api";

export const signin = async (email: string, password: string) => {
    await csrfCookie();
    const response = await apiAxios.post((API_ROUTES.LOGIN.PATH),
        { email, password }
    )

    if (response.status === 200 && response.headers.getContentType === 'application/json') {
        const responseData = response.data;
        return responseData;
    }
    return undefined;
}
