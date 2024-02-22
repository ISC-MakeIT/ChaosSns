import { BsTwitter } from "react-icons/bs";
import WhiteText from "../atoms/WhiteText";

interface NotificationItemProps {
    body: string
};

export const NotificationItem: React.FC<NotificationItemProps> = ({ body }) => {
    return (
        <div className="flex flex-row items-center p-6 gap-4 border-b-[1px] border-neutral-800">
            <BsTwitter color="white" size={32} />
            <WhiteText>{body}</WhiteText>
        </div>
    );
}