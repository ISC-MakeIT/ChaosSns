import { headers } from "next/headers";
import { API_ROUTES, apiAxios } from "@/consts/api";

type ResponseData = {
  message: string;
  count: number;
};

const getNotReadNotificationsCount = async (): Promise<number> => {
  try {
    const headerList = headers();

    const response = await apiAxios.get<ResponseData>(
      API_ROUTES.GET_NOT_READ_NOTIFICATIONS_COUNT.PATH,
      {
        headers: {
          Cookie: headerList.get("Cookie") ?? "",
          referer: headerList.get("referer") ?? "",
        },
      },
    );
    return response.data.count;
  } catch (e) {
    console.error(e);
  }
  return 0;
};

export default getNotReadNotificationsCount;
