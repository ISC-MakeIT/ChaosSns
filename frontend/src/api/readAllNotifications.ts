import { API_ROUTES, apiAxios } from "@/consts/api";
import { csrfCookie } from ".";

export const readAllNotifications = async () => {
  try {
    await csrfCookie();
    await apiAxios.post(API_ROUTES.READ_ALL_NOTIFICATIONS.PATH);
  } catch (e) {
    console.error(e);
  }
};
