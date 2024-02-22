interface HeaderTitleProps {
  children: React.ReactNode;
}

export const HeaderTitle: React.FC<HeaderTitleProps> = ({ children }) => {
  return <h1 className="text-white text-xl font-semibold">{children}</h1>;
};
