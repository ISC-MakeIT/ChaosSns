import { csrfCookie } from "@/api";
import { API_ROUTES, apiAxios } from "@/consts/api";

export const signout = async () => {
  await csrfCookie();
  const response = await apiAxios.post(API_ROUTES.LOGOUT.PATH);

  if (
    response.status === 200 &&
    response.headers.getContentType === "application/json"
  ) {
    const responseData = response.data;
    return responseData;
  }
  return undefined;
};
