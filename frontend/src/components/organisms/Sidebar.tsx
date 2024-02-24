import SidebarItem from "../molecules/SidebarItem";
import { AiOutlineHome, AiOutlineBell, AiOutlineUser } from "react-icons/ai";
import { SidebarTweetButton } from "../molecules/SidebarTweetButton";
import { TwitterLogo } from "../atoms/TwitterLogo";
import SidebarLogout from "../molecules/SidebarLogout";
import useCurrentUser from "@/hooks/server/useCurrentUser";

export const Sidebar = async () => {
  const response = await useCurrentUser();

  const items = [
    {
      label: "ホーム",
      href: "/",
      icon: AiOutlineHome,
    },
    {
      label: "通知",
      href: "/notifications",
      icon: AiOutlineBell,
    },
  ];

  if (response) {
    items.push({
      label: "プロフィール",
      href: `/users/${response.user.id}`,
      icon: AiOutlineUser,
    });
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
