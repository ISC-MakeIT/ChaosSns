'use client'

import { useCallback, useState } from "react";
import axios from "axios";
import toast from "react-hot-toast";
// import { signin } from 'next-auth/react';

import useRegisterModal from "@/hooks/useRegisterModal";
import useLoginModal from "@/hooks/useLoginModal";

import Modal from "./Modal";
import Input from "../atoms/Input";
import { register } from "@/hooks/register";
import { signin } from "@/hooks/signin";

const RegisterModal = () => {
  const registerModal = useRegisterModal();
  const loginModal = useLoginModal();

  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [name, setName] = useState('');
  const [username, setUsername] = useState('');
  const [isLoading, setIsLoading] = useState(false);

  const onSubmit = useCallback(async () => {
    try {
      setIsLoading(true);

      // TODO: Add REGISTER AND LOG IN
      console.dir({ email, password, name })
      await register(email, password, name);

      toast.success('アカウントを作成しました。')

      await signin(email, password)

      toast.success('ログインしました。')

      registerModal.onClose();
    } catch (error) {
      console.log(error)
      toast.error('何かが間違っている');
    } finally {
      setIsLoading(false)
    }
  }, [registerModal, email, password, username, name])
  // }, [registerModal])

  const onToggle = useCallback(() => {
    if (isLoading) {
      return;
    }
    registerModal.onClose();
    loginModal.onOpen();
  }, [isLoading, registerModal, loginModal])

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
        placeholder="Username"
        onChange={(e) => setUsername(e.target.value)}
        value={username}
        disabled={isLoading}
      />

      <Input
        placeholder="Password"
        onChange={(e) => setPassword(e.target.value)}
        value={password}
        disabled={isLoading}
      />
    </div>
  )

  const footerContent = (
    <div className="text-neutral-400 text-center mt-4">
      <p>すでにアカウントを持っていますか？
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
  )

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
  )
}

export default RegisterModal;
