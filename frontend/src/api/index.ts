import { API_ROUTES, apiAxios } from "@/consts/api";

export const csrfCookie = async () => {
  return await apiAxios.get(API_ROUTES.CSRF_COOKIE.PATH);
};
