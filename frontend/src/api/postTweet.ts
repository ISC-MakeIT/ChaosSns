import { API_ROUTES, apiAxios } from "@/consts/api";
import { csrfCookie } from ".";

const postTweet = async (text: string, file?: File): Promise<boolean> => {
  const formData = new FormData();
  formData.append("content", text);
  if (file && file.type.includes("video")) {
    formData.append("video", file);
  }
  if (file && file.type.includes("image")) {
    formData.append("image", file);
  }

  try {
    await csrfCookie();
    await apiAxios.post(API_ROUTES.POST_TWEET.PATH, formData);
  } catch (e) {
    console.log(e);
    return false;
  }
  return true;
};

export default postTweet;
