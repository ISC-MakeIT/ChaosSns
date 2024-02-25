import { API_ROUTES, apiAxios } from "@/consts/api";
import useSWR from "swr";
import { csrfCookie } from "..";

type ResponseData = {
  message: string;
  count: number;
};

const fetcher = async (url: string) => {
  await csrfCookie();
  return (await apiAxios.get(url)).data;
};

const getNotReadNotificationsCount = async () => {
  const { data, error, isLoading, mutate } = useSWR(
    API_ROUTES.GET_NOT_READ_NOTIFICATIONS_COUNT.PATH,
    fetcher,
  );

  return {
    data,
    error,
    isLoading,
    mutate,
  };
};

export default getNotReadNotificationsCount;
