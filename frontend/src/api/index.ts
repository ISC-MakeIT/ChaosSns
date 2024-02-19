import { API_BASE_URL, API_ROUTES } from "@/consts/api"
import { buildURL } from "@/helpers/buildURL"

export const csrfCookie = async () => {
    return await fetch(buildURL(API_BASE_URL, API_ROUTES.CSRF_COOKIE.PATH), {
		headers: {
			'Content-Type': 'application/json'
		},
        method: API_ROUTES.CSRF_COOKIE.METHOD
    });
}