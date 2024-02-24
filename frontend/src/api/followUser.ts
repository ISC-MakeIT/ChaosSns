import { API_ROUTES, apiAxios } from "@/consts/api"
import { csrfCookie } from ".";

export const followUser = async (targetUserId: number): Promise<boolean> => {
    await csrfCookie();
    try {
        await apiAxios.post(API_ROUTES.FOLLOW_USER.PATH + String(targetUserId));
    } catch (e) {
        console.log(e)
        return false;
    }
    return true;
}