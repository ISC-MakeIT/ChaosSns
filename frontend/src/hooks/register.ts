import { csrfCookie } from "@/api";
import { API_ROUTES, apiAxios } from "@/consts/api";

export type User = {
  id: number;
  email: string;
  name: string;
  description: string;
  icon: string;
};

export const register = async (
  email: string,
  password: string,
  name: string,
  imageFile: File,
): Promise<User | undefined> => {
  const blob = new Blob([imageFile], { type: "image/png" });

  const formData = new FormData();
  formData.append("icon", blob);
  formData.append("email", email);
  formData.append("password", password);
  formData.append("name", name);
  formData.append("description", "default");

  await csrfCookie();

  const response = await apiAxios.post(
    API_ROUTES.REGISTRATION_USER.PATH,
    formData,
  );

  if (
    response.status === 200 &&
    response.headers.getContentType === "application/json"
  ) {
    const responseData = response.data;
    return responseData;
  }
  return undefined;
};
