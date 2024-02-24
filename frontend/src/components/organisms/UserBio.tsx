"use client";

import { User } from "@/types/user";
import Button from "../atoms/Button";
import { BiCalendar } from "react-icons/bi";
import { followUser } from "@/api/followUser";
import toast from "react-hot-toast";
import { useState } from "react";
import EditUserModal from "./EditUserModel";
import useEditUserModal from "@/hooks/useEditUserModal";

interface UserBioProps {
  currentUserId?: number;
  user: User;
  isFollowing: boolean;
}

const UNFOLLOW = "フォローを外す";
const FOLLOW = "フォローする";

const UserBio: React.FC<UserBioProps> = ({
  currentUserId,
  user,
  isFollowing,
}) => {
  const [isFollowed, setIsFollowed] = useState<boolean>(isFollowing);
  const [followLabel, setFollowLabel] = useState<string>(
    isFollowing ? UNFOLLOW : FOLLOW,
  );
  const editUserModal = useEditUserModal();

  const handleToggleFollow = () => {
    if (!currentUserId) {
      toast.error("ログインを行ってください。");
      return;
    }

    const actionSuccessful = followUser(user.id);

    if (!actionSuccessful) {
      toast.error("フォローに失敗しました。");
      return;
    }
    if (isFollowed) {
      setIsFollowed(false);
      setFollowLabel(FOLLOW);
      toast.success("フォローを外しました。");
      return;
    }
    setIsFollowed(true);
    setFollowLabel(UNFOLLOW);
    toast.success("フォローをしました。");
  };

  const button =
    currentUserId === user.id ? (
      <Button secondary onClick={editUserModal.onOpen} label="編集" />
    ) : (
      <Button secondary onClick={handleToggleFollow} label={followLabel} />
    );

  return (
    <div className="border-b-[1px] border-neutral-800 pb-4">
      <EditUserModal oldDescription={user.description} oldName={user.name} />
      <div className="flex justify-end p-2">{button}</div>
      <div className="mt-8 px-4">
        <div className="flex flex-col">
          <p className="text-white text-2xl font-semibold">{user.name}</p>
        </div>
        <div className="flex flex-col mt-4">
          <p className="text-white">{user.description}</p>
          <div
            className="
                flex 
                flex-row 
                items-center 
                gap-2 
                mt-4 
                text-neutral-500
            "
          >
            <BiCalendar size={24} />
            <p>作成した日時 {user.created_at}</p>
          </div>
        </div>
      </div>
    </div>
  );
};

export default UserBio;
