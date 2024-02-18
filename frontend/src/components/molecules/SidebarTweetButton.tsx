import { FaFeather } from "react-icons/fa";
import { SidebarTweetText } from "../atoms/SidebarTweetText";

export const SidebarTweetButton = () => {
  return (
    <div>
      <div className="mt-6 lg:hidden rounded-full h-14 w-14 p-4 flex items-center justify-center bg-sky-500 hover:bg-opacity-80 transition cursor-pointer">
        <FaFeather size={24} color="white" />
      </div>
      <SidebarTweetText />
    </div>
  );
};
