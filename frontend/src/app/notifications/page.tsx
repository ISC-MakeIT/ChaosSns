import getNotifications from "@/api/server/getNotifications";
import Header from "@/components/organisms/Header";
import NotificationItemList from "@/components/organisms/NotificationItemList";

export default async function Index() {
  const notifications = await getNotifications();

  return (
    <div>
      <Header>通知</Header>
      <NotificationItemList notifications={notifications} />
    </div>
  );
}
