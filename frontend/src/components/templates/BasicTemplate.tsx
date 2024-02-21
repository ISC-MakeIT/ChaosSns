import { useUser } from "@/hooks/user";
import Modal from "../atoms/Modal";
import { FollowBar } from "../organisms/Followbar";
import { Sidebar } from "../organisms/Sidebar";
import LoginModal from "../LoginModal";
import RegisterModal from "../RegisterModal";

interface LayoutProps {
  children: React.ReactNode;
}

export const BasicTemplate: React.FC<LayoutProps> = async ({ children }) => {
  const user = await useUser();
  
  return (
    <html>
      <body>
        <RegisterModal />
        <LoginModal />
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
  );
};
