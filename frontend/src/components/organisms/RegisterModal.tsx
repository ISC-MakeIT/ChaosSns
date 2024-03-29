"use client";

import { useCallback, useState } from "react";
import toast from "react-hot-toast";

import useRegisterModal from "@/hooks/useRegisterModal";
import useLoginModal from "@/hooks/useLoginModal";

import Modal from "./Modal";
import Input from "../atoms/Input";
import { register } from "@/hooks/register";
import { signin } from "@/hooks/signin";

const RegisterModal = () => {
  const registerModal = useRegisterModal();
  const loginModal = useLoginModal();

  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [name, setName] = useState("");
  const [imageFile, setImageFile] = useState<File>();
  const [isLoading, setIsLoading] = useState(false);

  const onSubmit = useCallback(async () => {
    try {
      setIsLoading(true);

      console.dir({ email, password, name, imageFile });
      await register(email, password, name, imageFile!);
      toast.success("アカウントを作成しました。");

      await signin(email, password);
      toast.success("ログインしました。");

      registerModal.onClose();
    } catch (error) {
      console.log(error);
      toast.error("何かが間違っている");
    } finally {
      setIsLoading(false);
    }
  }, [registerModal, email, password, name, imageFile]);

  const onToggle = useCallback(() => {
    if (isLoading) {
      return;
    }
    registerModal.onClose();
    loginModal.onOpen();
  }, [isLoading, registerModal, loginModal]);

  const bodyContent = (
    <div className="flex flex-col gap-4">
      <Input
        placeholder="Email"
        onChange={(e) => setEmail(e.target.value)}
        value={email}
        disabled={isLoading}
      />

      <Input
        placeholder="Name"
        onChange={(e) => setName(e.target.value)}
        value={name}
        disabled={isLoading}
      />

      <Input
        placeholder="Password"
        onChange={(e) => setPassword(e.target.value)}
        value={password}
        disabled={isLoading}
        type="password"
      />

      <input type="file" onChange={(e) => setImageFile(e.target.files![0])} />
    </div>
  );

  const footerContent = (
    <div className="text-neutral-400 text-center mt-4">
      <p>
        すでにアカウントを持っていますか？
        <span
          onClick={onToggle}
          className="
          text-white
          cursor-pointer
          hover:underline
          "
        >
          サインイン
        </span>
      </p>
    </div>
  );

  return (
    <Modal
      disabled={isLoading}
      isOpen={registerModal.isOpen}
      title="新規登録"
      actionLabel="登録する"
      onClose={registerModal.onClose}
      onSubmit={onSubmit}
      body={bodyContent}
      footer={footerContent}
    />
  );
};

export default RegisterModal;
