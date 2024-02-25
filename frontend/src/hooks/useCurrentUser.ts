import useSWR from "swr";
import { API_ROUTES, apiAxios } from "@/consts/api";
import { csrfCookie } from "@/api";
import { User } from "@/types/user";

type ResponseData = {
  message: string;
  user: User;
};

const fetcher = async (url: string) => {
  await csrfCookie();
  return (await apiAxios.get(url)).data;
};

function useCurrentUser() {
  const { data, error, isLoading, mutate } = useSWR<ResponseData>(
    API_ROUTES.GET_LOGGEDIN_USER.PATH,
    fetcher,
  );

  return {
    data,
    error,
    isLoading,
    mutate,
  };
}

export default useCurrentUser;
