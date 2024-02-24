import { csrfCookie } from "@/api";
import { API_ROUTES, apiAxios } from "@/consts/api";

export const updateUser = async (description: string, name: string) => {
  await csrfCookie();
  const response = await apiAxios.put(API_ROUTES.UPDATE_USER.PATH, {
    description,
    name,
  });

  if (
    response.status === 200 &&
    response.headers.getContentType === "application/json"
  ) {
    const responseData = response.data;
    return responseData;
  }
  return undefined;
};
