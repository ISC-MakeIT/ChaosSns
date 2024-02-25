'use client'

import getNotifications from "@/api/server/getNotifications";
import Header from "@/components/organisms/Header";
import NotificationItemList from "@/components/organisms/NotificationItemList";
import Client from "./client";

export default function Index() {
  const { data: response, error } = getNotifications();

  if (response && !error) {
    return (
      <div>
        <Client />
        <Header>通知</Header>
        <NotificationItemList notifications={response.notifications} />
      </div>
    );
  }
  return <></>
}
