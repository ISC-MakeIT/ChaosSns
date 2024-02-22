import { NotificationItem } from "../molecules/NotificationItem";

interface Notification {
    id: string;
    content: string;
}

interface NotificationItemListProps {
    notifications: Notification[];
};

const NotificationItemList: React.FC<NotificationItemListProps> = ({ notifications }) => {
    const notificationItemList = notifications.map((notification) => {
        return <NotificationItem key={notification.id} body={notification.content} />
    })
    
    return (
        <div className="flex flex-col">
            {notificationItemList}
        </div>
    );
}

export default NotificationItemList;