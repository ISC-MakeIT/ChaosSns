import useSWR from 'swr';
import { API_ROUTES, apiAxios } from "@/consts/api";
import { csrfCookie } from '@/api';

const fetcher = async (url: string) => {
    await csrfCookie();
    return (await apiAxios.get(url)).data;
}

function useTweets(userId?: string) {
    // FIXME: endpoint
    
    const { data, error, isLoading, mutate } = useSWR(API_ROUTES.GET_TWEETS.PATH, fetcher)


    // const { data, error, isLoading, mutate } = useSWR(userId ? `${API_ROUTES.GET_TWEETS.PATH}/${userId}` : null, fetcher)

    return {
        data, error, isLoading, mutate
    }
}


export default useTweets;
