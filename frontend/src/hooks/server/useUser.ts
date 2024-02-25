import { API_ROUTES, apiAxios } from "@/consts/api";
import { User } from "@/types/user";
import { headers } from "next/headers";

type ResponseData = {
  message: string;
  isFollowing: boolean;
  user: User;
};

const useUser = async (id: number) => {
  let data: ResponseData | undefined = undefined;

  try {
    const headerList = headers();

    const response = await apiAxios.get<ResponseData>(
      API_ROUTES.GET_USER.PATH + id,
      {
        headers: {
          Cookie: headerList.get("Cookie") ?? "",
          referer: headerList.get("referer") ?? "",
        },
      },
    );
    data = await response.data;
  } catch (e) {
    // console.error(e)
  }

  return data;
};

export default useUser;
