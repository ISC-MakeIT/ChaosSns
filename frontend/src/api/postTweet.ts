import { API_ROUTES, apiAxios } from "@/consts/api";
import { csrfCookie } from ".";

const postTweet = async (text?: string, file?: File): Promise<boolean> => {
  console.dir(file)
  try {
    await csrfCookie();
    await apiAxios.post(API_ROUTES.POST_TWEET.PATH, {
      content: text,
      // TODO: 画像や動画も投稿できるようにする
      // image: file,
      // video: '',
    });
  } catch (e) {
    console.log(e);
    return false;
  }
  return true;
};

export default postTweet;
