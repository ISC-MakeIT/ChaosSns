import Image from "next/image";

interface AvatarProps {
  icon: string;
  isLarge?: boolean;
  hasBorder?: boolean;
}

const Avatar: React.FC<AvatarProps> = ({ icon, isLarge, hasBorder }) => {
  return (
    <div
      className={`
          ${hasBorder ? "border-4 border-black" : ""}
          ${isLarge ? "h-32" : "h-12"}
          ${isLarge ? "w-32" : "w-12"}
          rounded-full 
          hover:opacity-90 
          transition 
          cursor-pointer
          relative
        `}
    >
      <Image
        fill
        style={{
          objectFit: "cover",
          borderRadius: "100%",
        }}
        alt="Avatar"
        src={icon || "/images/placeholder.png"}
      />
    </div>
  );
};

export default Avatar;
