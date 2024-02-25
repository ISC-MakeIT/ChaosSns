import useSWR from "swr";
import { API_ROUTES, apiAxios } from "@/consts/api";
import { csrfCookie } from "@/api";

const fetcher = async (url: string) => {
  await csrfCookie();
  return (await apiAxios.get(url)).data;
};

function useTweet(tweetId: string) {
  const { data, error, isLoading, mutate } = useSWR(
    tweetId ? `/api/tweets/${tweetId}` : null,
    fetcher,
  );
  // FIXME: endpoint

  return {
    data,
    error,
    isLoading,
    mutate,
  };
}

export default useTweet;
