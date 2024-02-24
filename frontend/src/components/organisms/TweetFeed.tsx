"use client";

import useTweets from "@/hooks/useTweets";
import TweetItem from "../atoms/TweetItem";

interface TweetFeedProps {
  userId?: string;
}

const TweetFeed: React.FC<TweetFeedProps> = ({ userId }) => {
  const { data: posts = [] } = useTweets(userId as string);

  return (
    <>
      {posts
        .map((post: Record<string, any>) => (
          <TweetItem userId={userId} key={post.id} data={post} />
        ))
        .reverse()}
    </>
  );
};

export default TweetFeed;
