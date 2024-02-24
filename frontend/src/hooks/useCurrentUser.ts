import useSWR from 'swr';
import { API_ROUTES, apiAxios } from "@/consts/api";
import { csrfCookie } from '@/api';

const fetcher = async (url: string) => {
    await csrfCookie();
    return (await apiAxios.get(url)).data;
}

function useCurrentUser() {
    const { data, error, isLoading, mutate } = useSWR(API_ROUTES.GET_LOGGEDIN_USER.PATH, fetcher)

    return {
        data, error, isLoading, mutate
    }
}


export default useCurrentUser;
