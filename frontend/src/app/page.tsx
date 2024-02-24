import Form from "@/components/molecules/Form";
import Header from "@/components/organisms/Header";
import TweetFeed from "@/components/organisms/TweetFeed";

export default function Home() {

  return (
    <div>
      <Header>ホーム</Header>
      <Form placeholder="What's happening?" />
      <TweetFeed />
    </div>
  );
}
