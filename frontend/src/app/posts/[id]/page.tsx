"use client";

import ReplyForm from "@/components/molecules/ReplyForm";
import Header from "@/components/organisms/Header";
import { TweetDetails } from "@/components/organisms/TweetDetails";
import useTweet from "@/hooks/useTweet";

const Index = ({ params }: { params: { id: string } }) => {
  const { data: tweet } = useTweet(params.id);
  // console.log(tweet,params);

  return (
    <div>
      <Header>投稿</Header>
      <TweetDetails tweet={tweet} />
      <ReplyForm placeholder="返信をツイート" />
    </div>
  );
};

export default Index;
