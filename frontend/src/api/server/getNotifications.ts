import { API_ROUTES, apiAxios } from "@/consts/api";
import { Notification } from "@/types/notification";
import { csrfCookie } from "..";
import useSWR from "swr";

type ResponseData = {
  message: string;
  notifications: Notification[];
};

const fetcher = async (url: string) => {
  await csrfCookie();
  return (await apiAxios.get(url)).data;
};

const getNotifications = () => {
  const { data, error, isLoading, mutate } = useSWR<ResponseData>( // eslint-disable-line
    API_ROUTES.GET_NOTIFICATIONS.PATH,
    fetcher,
  );

  return {
    data,
    error,
    isLoading,
    mutate,
  };
};

export default getNotifications;
