"use client";

import { useCallback, useState } from "react";
import toast from "react-hot-toast";

import usePostTweetModal from "@/hooks/usePostTweetModal";

import Modal from "./Modal";
import { AiOutlinePicture } from "react-icons/ai";
import Button from "../atoms/Button";
import Avatar from "../atoms/Avatar";
import useCurrentUser from "@/hooks/useCurrentUser";
import postTweet from "@/api/postTweet";


const PostTweetModal = () => {
  const postTweetModal = usePostTweetModal();

  const { data: currentUser } = useCurrentUser();

  const [text, setText] = useState("");
  const [imageFile, setImageFile] = useState<File>();

  const [isLoading, setIsLoading] = useState(false);

  const onSubmit = useCallback(async () => {
    try {
      setIsLoading(true);

      // TODO: ツイート投稿処理
      // await signin(email, password);
      await postTweet(text, imageFile);
      toast.success("投稿しました。");

      postTweetModal.onClose();
    } catch (error) {
      console.log(error);
      toast.error("投稿に失敗しました。");
    } finally {
      setIsLoading(false);
    }
  }, [postTweetModal, text]);


  const bodyContent = (
    <div className="flex flex-col gap-4">
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
          placeholder="テキストを入力"
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

          {/*<input type="file" onChange={(e) => setImageFile(e.target.files![0])} /> */}

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
              <AiOutlinePicture size={30} />
            </label>
            <input id="img" type="file"
              accept=".jpg, .jpeg, .png, .mp4"
              onChange={(e) => setImageFile(e.target.files![0])} hidden />
            {imageFile && `${imageFile.name} が選択されています...`}

          </div>
          <Button
            disabled={isLoading || (!text && !imageFile)}
            onClick={onSubmit}
            label="Tweet"
          />
        </div>
      </div>
    </div>
  );



  return (
    // FIXME: buttonDisableを指定できるのでハンドラを登録しなくても良いようにしたい
    <Modal
      disabled={isLoading}
      isOpen={postTweetModal.isOpen}
      title="投稿"
      actionLabel="投稿する"
      onClose={postTweetModal.onClose}
      onSubmit={() => { }}
      body={bodyContent}
      buttonDisable
    />
  );
};

export default PostTweetModal;
