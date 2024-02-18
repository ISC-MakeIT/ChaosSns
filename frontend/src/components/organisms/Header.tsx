interface HeaderProps {
  children: string;
}

export const Header: React.FC<HeaderProps> = ({ children }) => {
  return (
    <div className="border-b-[1px] border-neutral-800 p-5">
      <div className="flex flex-row items-center gap-2">
        <h1 className="text-white text-xl font-semibold">{children}</h1>
      </div>
    </div>
  );
};