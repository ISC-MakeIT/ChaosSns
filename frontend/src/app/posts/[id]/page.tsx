"use client";

import ReplyItem from "@/components/atoms/ReplyItem";
import ReplyForm from "@/components/molecules/ReplyForm";
import Header from "@/components/organisms/Header";
import { TweetDetails } from "@/components/organisms/TweetDetails";
import useReplies from "@/hooks/useReplies";
import useTweet from "@/hooks/useTweet";

const Index = ({ params }: { params: { id: string; user_id: string } }) => {
  const { data: tweet } = useTweet(params.id);
  const { data: replies = [] } = useReplies(params.user_id as string);
  if (!tweet) {
    return false;
  }

  return (
    <div>
      <Header>投稿</Header>
      <TweetDetails tweet={tweet} />
      <ReplyForm placeholder="返信をツイート" reply_to={params.id} />
      {replies.map((reply: Record<string, any>) => (
        <ReplyItem key={tweet.id} data={tweet} userId={tweet.user_id} />
      ))}
    </div>
  );
};

export default Index;
