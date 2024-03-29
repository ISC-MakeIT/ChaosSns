import { FollowBar } from "../organisms/Followbar";
import { Sidebar } from "../organisms/Sidebar";
import LoginModal from "../organisms/LoginModal";
import RegisterModal from "../organisms/RegisterModal";
import { Toaster } from "react-hot-toast";
import PostTweetModal from "../organisms/PostTweetModal";

interface LayoutProps {
  children: React.ReactNode;
}

export const BasicTemplate: React.FC<LayoutProps> = async ({ children }) => {
  return (
    <>
      <html>
        <body className="animate-[rainbow_1s_infinite]">
          <RegisterModal />
          <LoginModal />
          <Toaster />
          <PostTweetModal />
          <div className="h-screen bg-black">
            <div className="container h-full mx-auto xl:px-30 max-w-6xl">
              <div className="grid grid-cols-4 h-full">
                <Sidebar />
                <div className="col-span-3 lg:col-span-2 border-x-[1px] border-neutral-800">
                  {children}
                </div>
                <FollowBar />
              </div>
            </div>
          </div>
        </body>
      </html>
    </>
  );
};
