import { create } from "zustand";

interface PostTweetModalStore {
  isOpen: boolean;
  onOpen: () => void;
  onClose: () => void;
}

const usePostTweetModal = create<PostTweetModalStore>((set) => ({
  isOpen: false,
  onOpen: () => set({ isOpen: true }),
  onClose: () => set({ isOpen: false }),
}));

export default usePostTweetModal;
