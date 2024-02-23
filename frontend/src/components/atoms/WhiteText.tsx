interface WhiteTextProps {
    children: React.ReactNode
}

const WhiteText: React.FC<WhiteTextProps> = ({ children }) => {
    return (
        <p className="text-white">{children}</p>
    )
}

export default WhiteText;