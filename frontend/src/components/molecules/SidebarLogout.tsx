'use client'

import { signout } from "@/hooks/signout";
import { useCallback } from "react";
import { BiLogOut } from "react-icons/bi";
import toast from 'react-hot-toast'


const SidebarLogout = () => {
    const handleSignout = useCallback(async () => {
        try {
            await signout()
            toast.success('ログアウトしました。')
            location.reload();
        } catch (error) {
            console.log(error)
        }
    }, [signout, toast])

    return (
        <div onClick={handleSignout} className="flex flex-row items-center">
            <div className="relative rounded-full h-14 w-14 flex items-center justify-center p-4 hover:bg-slate-300 hover:bg-opacity-10 cursor-pointer lg:hidden">
                <BiLogOut size={28} color="white" />
            </div>
            <div className="relative hidden lg:flex items-center gap-4 p-4 rounded-full hover:bg-slate-300 hover:bg-opacity-10 cursor-pointer">
                <BiLogOut size={28} color="white" />
                <p className="hidden lg:block text-white text-xl">ログアウト</p>
            </div>
        </div>
    );
};

export default SidebarLogout;
