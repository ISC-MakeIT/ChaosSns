import useSWR from 'swr';
import { API_ROUTES, apiAxios } from "@/consts/api";

const fetcher = (url: string) => apiAxios.get(url).then(res => res.data)

function useCurrentUser() {
    const { data, error, isLoading, mutate } = useSWR(API_ROUTES.GET_LOGGEDIN_USER.PATH, fetcher)
    return {
        data, error, isLoading, mutate
    }
}


export default useCurrentUser;
