interface NeutalTextProps {
    children: React.ReactNode;
  }

const NeutralText: React.FC<NeutalTextProps> = ({children}) => {
  return <div className="text-neutral-600 text-center p-6 text-xl">{children}</div>
}

export default NeutralText;