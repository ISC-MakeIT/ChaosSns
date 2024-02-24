import useSWR from "swr";
import { API_ROUTES, apiAxios } from "@/consts/api";
import { csrfCookie } from "@/api";

const fetcher = async (url: string) => {
  await csrfCookie();
  return (await apiAxios.get(url)).data;
};

function useTweet(postId: string) {
  const { data, error, isLoading, mutate } = useSWR(
    postId ? `/api/posts/${postId}` : null,
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
