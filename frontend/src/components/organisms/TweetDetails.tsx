import { useEffect } from "react";
import Avatar from "../atoms/Avatar";
import { AiOutlineMessage } from "react-icons/ai";
import useCurrentUser from "@/hooks/useCurrentUser";
import { Tweet } from "@/types/tweet";

type TweetDetailsProps = {
  tweet: Tweet;
};

export const TweetDetails: React.FC<TweetDetailsProps> = ({ tweet }) => {
  useEffect(() => {
    console.log(tweet);
  });

  if (!tweet) {
    return false;
  }

  return (
    <div
      //   onClick={goToPost}
      className="
      border-b-[1px] 
      border-neutral-800 
      p-5 
      cursor-pointer 
      transition
    "
    >
      <div className="flex flex-row items-start gap-3">
        <div>
          <Avatar userId={""} />
        </div>
        <div>
          <div className="flex flex-row items-center gap-2">
            <p
              //   onClick={goToUser}
              className="
              text-white 
              font-semibold 
              cursor-pointer 
              hover:underline
          "
            >
              {/* {tweet.} */}
            </p>
            <span
              //   onClick={goToUser}
              className="
              text-neutral-500
              cursor-pointer
              hover:underline
              hidden
              md:block
          "
            >
              @{tweet.user_id}
            </span>
            {/* <span className="text-neutral-500 text-sm">{createdAt}</span> */}
          </div>
          <div className="text-white mt-1">{tweet.content}</div>
          <div className="flex flex-row items-center mt-3 mb-3 gap-10">
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
              <AiOutlineMessage size={20} />
              <p>{tweet.comments?.length || 0}</p>
            </div>
            <div
              // onClick={onLike}
              className="
              flex 
              flex-row 
              items-center 
              text-neutral-500 
              gap-2 
              cursor-pointer 
              transition 
              hover:text-red-500
          "
            >
              {/* <LikeIcon color={hasLiked ? 'red' : ''} size={20} />
            <p>
              {data.likedIds.length}
            </p>
            */}
            </div>
          </div>
          {/* {fileTag} */}
        </div>
      </div>
    </div>
  );
};
