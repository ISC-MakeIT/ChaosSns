import { API_ROUTES, apiAxios } from "@/consts/api";
import { ReadonlyHeaders } from "next/dist/server/web/spec-extension/adapters/headers";

export const csrfCookie = async (headers: ReadonlyHeaders) => {
  return await apiAxios.get(API_ROUTES.CSRF_COOKIE.PATH, {
    headers: {
      Cookie: headers.get("Cookie") ?? "",
      referer: headers.get("referer") ?? "",
    },
  });
};
