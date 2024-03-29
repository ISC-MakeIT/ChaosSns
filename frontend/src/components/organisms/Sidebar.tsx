"use client";

import SidebarItem from "../molecules/SidebarItem";
import { AiOutlineHome, AiOutlineBell, AiOutlineUser } from "react-icons/ai";
import { SidebarTweetButton } from "../molecules/SidebarTweetButton";
import { TwitterLogo } from "../atoms/TwitterLogo";
import SidebarLogout from "../molecules/SidebarLogout";
import getNotReadNotificationsCount from "@/api/server/getNotReadNotificationsCount";
import useCurrentUser from "@/hooks/useCurrentUser";

export const Sidebar = () => {
  const { data: response, error } = useCurrentUser();

  const items = [
    {
      label: "ホーム",
      href: "/",
      icon: AiOutlineHome,
    },
  ];

  if (response && !error) {
    let notificationsLabel = "通知";

    items.push(
      {
        label: notificationsLabel,
        href: "/notifications",
        icon: AiOutlineBell,
      },
      {
        label: "プロフィール",
        href: `/users/${response.user.id}`,
        icon: AiOutlineUser,
      },
    );
  }

  const sideItems = items.map((item) => {
    return (
      <SidebarItem
        key={item.href}
        href={item.href}
        label={item.label}
        icon={item.icon}
      />
    );
  });

  const sidebarLogout = response ? <SidebarLogout /> : <></>;

  return (
    <div className="col-span-1 h-full pr-4 md:pr-6">
      <div className="flex flex-col items-end">
        <div className="space-y-2 lg:w-[230px]">
          <div className="rounded-full h-14 w-14 p-4 flex items-center justify-center hover:bg-blue-300 hover:bg-opacity-10 cursor-pointer transition">
            <TwitterLogo />
          </div>
          {sideItems}
          {sidebarLogout}
          <SidebarTweetButton />
        </div>
      </div>
    </div>
  );
};
