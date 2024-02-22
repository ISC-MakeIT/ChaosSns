import { HeaderTitle } from "../atoms/HeaderTitle";

interface HeaderProps {
  children: React.ReactNode;
}

export const Header: React.FC<HeaderProps> = ({ children }) => {
  return (
    <div className="border-b-[1px] border-neutral-800 p-5">
      <div className="flex flex-row items-center gap-2">
        <HeaderTitle>{children}</HeaderTitle>
      </div>
    </div>
  );
};
