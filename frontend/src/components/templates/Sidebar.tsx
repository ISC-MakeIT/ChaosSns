import { AiOutlineHome, AiOutlineBell, AiOutlineUser } from "react-icons/ai";

import { SidebarLogo } from "../organisms/SidebarLogo";
import { SidebarItem } from "../organisms/SidebarItem";
import { SidebarTweetButton } from "../atoms/SidebarTweetButton";

export const Sidebar = () => {
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
    {
      label: "プロフィール",
      href: "/users/123",
      icon: AiOutlineUser,
    },
  ];

  return (
    <div className="col-span-1 h-full pr-4 md:pr-6">
      <div className="flex flex-col items-end">
        <div className="space-y-2 lg:w-[230px]">
          <SidebarLogo />
          {items.map((item) => (
            <SidebarItem
              key={item.href}
              href={item.href}
              label={item.label}
              icon={item.icon}
            />
          ))}
          <SidebarTweetButton />
        </div>
      </div>
    </div>
  );
};
