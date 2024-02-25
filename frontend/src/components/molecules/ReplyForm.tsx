"use client";

import { useCallback, useState } from "react";
import { toast } from "react-hot-toast";

import useLoginModal from "@/hooks/useLoginModal";
import useRegisterModal from "@/hooks/useRegisterModal";
import useCurrentUser from "@/hooks/useCurrentUser";
import useTweets from "@/hooks/useTweets";
import useTweet from "@/hooks/useTweet";

import Avatar from "../atoms/Avatar";
import Button from "../atoms/Button";
import postTweet from "@/api/postTweet";
import { AiOutlinePicture } from "react-icons/ai";

interface ReplyFormProps {
  placeholder: string;
  isComment?: boolean;
  postId?: string;
}

const ReplyForm: React.FC<ReplyFormProps> = ({
  placeholder,
  isComment,
  postId,
}) => {
  const registerModal = useRegisterModal();
  const loginModal = useLoginModal();

  const { data: currentUser } = useCurrentUser();
  const { mutate: mutateTweets } = useTweets();
  const { mutate: mutateTweet } = useTweet(postId as string);

  const [text, setText] = useState("");
  const [imageFile, setImageFile] = useState<File>();

  const [isLoading, setIsLoading] = useState(false);

  const onSubmit = useCallback(async () => {
    try {
      setIsLoading(true);

      await postTweet(text, imageFile);
      toast.success("投稿しました。");
      mutateTweets();
      mutateTweet();

      setText("");
      setImageFile(undefined);
    } catch (error) {
      console.log(error);
      toast.error("投稿に失敗しました。");
    } finally {
      setIsLoading(false);
    }
  }, [text, mutateTweets, isComment, postId, mutateTweet]);

  return (
    <div className="border-b-[1px] border-neutral-800 px-5 py-2">
      {currentUser ? (
        <div className="flex flex-row gap-4">
          <div>
            <Avatar userId={currentUser?.id} />
          </div>
          <div className="w-full">
            <textarea
              disabled={isLoading}
              onChange={(event) => setText(event.target.value)}
              value={text}
              className="
                  disabled:opacity-80
                  peer
                  resize-none 
                  mt-3 
                  w-full 
                  bg-black 
                  ring-0 
                  outline-none 
                  text-[20px] 
                  placeholder-neutral-500 
                  text-white
                "
              placeholder={placeholder}
            ></textarea>
            <hr
              className="
                  opacity-0 
                  peer-focus:opacity-100 
                  h-[1px] 
                  w-full 
                  border-neutral-800 
                  transition"
            />

            <div className="mt-4 flex flex-row justify-between">
              <div
                className="
                    flex 
                    flex-row 
                    items-center 
                    text-neutral-500 
                    gap-2 
                    cursor-pointer 
                    transition 
                    hover:text-sky-500
                "
              >
                <label htmlFor="img">
                  <AiOutlinePicture size={20} />
                </label>
                <input
                  id="img"
                  type="file"
                  accept=".jpg, .jpeg, .png, .mp4"
                  onChange={(e) => setImageFile(e.target.files![0])}
                  hidden
                />
                {imageFile && `${imageFile.name} が選択されています...`}
              </div>
              <Button
                disabled={isLoading || (!text && !imageFile)}
                onClick={onSubmit}
                label="返信"
              />
            </div>
          </div>
        </div>
      ) : (
        <div className="py-8">
          <h1 className="text-white text-2xl text-center mb-4 font-bold">
            うるさいSNSへようこそ!!!
          </h1>
          <div className="flex flex-row items-center justify-center gap-4">
            <Button label="ログイン" onClick={loginModal.onOpen} />
            <Button label="新規登録" onClick={registerModal.onOpen} secondary />
          </div>
        </div>
      )}
    </div>
  );
};

export default ReplyForm;