interface NeutalTextProps {
    children: React.ReactNode;
  }

export const NeutalText: React.FC<NeutalTextProps> = ({children}) => {
    return <div className="text-neutral-600 text-center p-6 text-xl">{children}</div>
}