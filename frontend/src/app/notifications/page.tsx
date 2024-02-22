import { Header } from "@/components/organisms/Header";
import { NotificationItemList } from "@/components/organisms/NotificationItemList";

export default function Index() {
  return (
    <div>
      <Header>通知</Header>
      {/* TODO: APIを叩く */}
      <NotificationItemList notifications={[{id: '1', content: 'aaa'}]} />
    </div>
  );
}
