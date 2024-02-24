import Header from "@/components/organisms/Header";
import UserBio from "@/components/organisms/UserBio";
import UserHero from "@/components/organisms/UserHero";
import useCurrentUser from "@/hooks/server/useCurrentUser";
import useUser from "@/hooks/server/useUser";
import { redirect } from "next/navigation";

export default async function Index(request: { params: { id: string } }) {
  const id = request.params.id;

  const currentUserData = await useCurrentUser();
  const userData = await useUser(Number(id));

  if (!userData) {
    return redirect("/");
  }

  return (
    <div>
      <Header>プロフィール</Header>
      <UserHero icon={userData.user.icon} />
      <UserBio
        currentUserId={currentUserData?.user.id}
        user={userData.user}
        isFollowing={userData.isFollowing}
      />
    </div>
  );
}
