'use client'

import { useCallback, useState } from "react";
import Modal from "./Modal";
import Input from "../atoms/Input";
import toast from "react-hot-toast";
import useEditUserModal from "@/hooks/useEditUserModal";
import { updateUser } from "@/api/updateUser";

type EditUserModalProps = {
    oldDescription: string;
    oldName: string;
}

const EditUserModal: React.FC<EditUserModalProps> = ({ oldDescription, oldName }) => {
  const editUserModal = useEditUserModal();

  const [description, setDescription] = useState(oldDescription);
  const [name, setName]               = useState(oldName);
  const [isLoading, setIsLoading]     = useState(false);

  const onSubmit = useCallback(async () => {
    try {
      setIsLoading(true);
      
      await updateUser(description, name);
      toast.success('ユーザーを更新しました。')

      location.reload();
    } catch (error) {
      console.log(error)
    } finally {
      setIsLoading(false)
    }
  }, [description, name])

  const bodyContent = (
    <div className="flex flex-col gap-4">
      <Input
        placeholder="お名前"
        onChange={(e) => setName(e.target.value)}
        value={name}
        disabled={isLoading}
        type="text"
      />
      
      <Input
        placeholder="自己紹介"
        onChange={(e) => setDescription(e.target.value)}
        value={description}
        disabled={isLoading}
      />
    </div>
  );

  return (
    <Modal
      disabled={isLoading}
      isOpen={editUserModal.isOpen}
      title="ユーザー編集"
      actionLabel="編集"
      onClose={editUserModal.onClose}
      onSubmit={onSubmit}
      body={bodyContent}
    />
  )
}

export default EditUserModal;
