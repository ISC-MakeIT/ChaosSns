'use client'

import Header from "@/components/organisms/Header";
import { User, useUser } from "@/hooks/user";
import { useEffect, useState } from "react";

export default function Home() {
  const [user, setUser] = useState<User | undefined>();

  useEffect(() => {
    (async () => {
      try {
        const data = await useUser()
        setUser(data)
      } catch (e) {
        console.log(e)
      }
    })()
  }, [])

  return (
    <div>
      <Header>ホーム</Header>
      <p className="text-white">
        {user?.name ?? 'user name none'}
        {user?.email ?? 'user email none'}
      </p>
    </div>
  );
}
