import { csrfCookie } from "@/api/server/csrfCookie";
import { API_ROUTES, apiAxios } from "@/consts/api"
import { User } from "@/types/user";
import { headers } from "next/headers";

type ResponseData = {
  message: string;
  user: User;
}

const useCurrentUser = async (): Promise<ResponseData|undefined> => {
    let data: ResponseData|undefined = undefined;
    
    try {
      const headerList = headers();
      
      await csrfCookie(headerList);
      const response = await apiAxios.get<ResponseData>(API_ROUTES.GET_LOGGEDIN_USER.PATH, {
        headers: {
          Cookie: headerList.get('Cookie') ?? '',
          referer: headerList.get('referer') ?? ''
        }
      });
      data = await response.data;
    } catch (e) {
      console.error(e)
    }

    return data;
}

export default useCurrentUser;