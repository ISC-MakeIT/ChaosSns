interface WhiteTextProps {
    children: React.ReactNode
}

export const WhiteText: React.FC<WhiteTextProps> = ({ children }) => {
    return (
        <p className="text-white">{children}</p>
    )
}