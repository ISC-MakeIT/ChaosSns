import Avatar from "../molecules/Avatar"

interface UserHeroProps {
    icon: string;
}

const UserHero: React.FC<UserHeroProps> = ({ icon }) => {
    return (
        <div>
        <div className="bg-neutral-700 h-44 relative">
            <div className="absolute -bottom-16 left-4">
                <Avatar icon={icon} isLarge hasBorder />
            </div>
        </div>
        </div>
    );
}

export default UserHero;