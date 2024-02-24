import { API_ROUTES, apiAxios } from "@/consts/api";
import { csrfCookie } from "..";
import { Notification } from "@/types/notification";
import { headers } from "next/headers";

type ResponseData = {
  message: string;
  notifications: Notification[];
};

const getNotifications = async (): Promise<Notification[]> => {
  await csrfCookie();
  try {
    const headerList = headers();

    const response = await apiAxios.get<ResponseData>(
      API_ROUTES.GET_NOTIFICATIONS.PATH,
      {
        headers: {
          Cookie: headerList.get("Cookie") ?? "",
          referer: headerList.get("referer") ?? "",
        },
      },
    );
    return response.data.notifications;
  } catch (e) {
    console.error(e);
  }
  return [];
};

export default getNotifications;
