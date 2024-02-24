import getNotifications from "@/api/server/getNotifications";
import Header from "@/components/organisms/Header";
import NotificationItemList from "@/components/organisms/NotificationItemList";
import Client from "./client";

export default async function Index() {
  const notifications = await getNotifications();
  
  return (
    <div>
      <Client />
      <Header>通知</Header>
      <NotificationItemList notifications={notifications} />
    </div>
  );
}
