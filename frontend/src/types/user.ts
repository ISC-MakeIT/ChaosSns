import { Tweet } from "./tweet";

export interface User {
  id: number;
  description: string;
  name: string;
  icon: string;
  created_at: string;
  updated_at: string;
  tweets: Tweet[];
}
