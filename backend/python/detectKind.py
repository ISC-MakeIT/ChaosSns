from text_vectorian import SentencePieceVectorian
from enum import Enum
import numpy as np
import sys

class TweetKind(Enum):
    LIKE  = "like"
    BAD   = "bad"
    SMELL = "smell"

def cos_sim(v1, v2):
    return np.inner(v1, v2) / (np.linalg.norm(v1) * np.linalg.norm(v2))

def is_close(v1, v2, close_value) -> bool:
    sim = cos_sim(v1, v2)
    return sim >= close_value

input  = sys.argv[1]
output = TweetKind.LIKE

texts = {
    "like": [
        "怒り",
        "疲れた",
        "孤独感",
        "理解されない",
        "空虚",
        "希望が見えない",
        "失望",
        "挫折",
        "不安定",
        "心が重い",
        "苦悩",
        "失意",
        "無価値",
        "辛い",
        "孤立",
        "絶望",
        "不満",
        "ストレス",
        "圧倒される",
        "無力感",
        "落胆",
        "焦燥感",
        "不幸",
        "煩わしい",
        "悔しい",
        "被害妄想",
        "無関心",
        "不機嫌",
        "冷めた",
        "過敏",
        "不信感",
        "悲観的",
        "焦り",
        "自己嫌悪",
        "不安",
        "心配",
        "無意味",
        "退屈",
        "疎外感",
        "罪悪感",
        "恐怖",
        "悲しみ",
        "怠け者",
        "不健康",
        "無関係",
        "遅刻",
        "遅れ",
        "見捨てられた感",
        "信頼性の欠如",
        "愛の欠如",
        "情熱の欠如",
        "目標の欠如",
        "意欲の欠如",
        "刺激の欠如",
        "孤独",
        "責任逃れ",
        "嫉妬",
        "逆恨み",
        "心の病",
        "悲劇",
        "虚無感",
        "感情の乱れ",
        "情緒不安定",
        "精神的疲労",
        "心理的負担",
        "社会的不安",
        "孤立無援",
        "病的な",
        "恨み",
        "不運",
        "不条理",
        "無秩序",
        "混乱",
        "破壊",
        "崩壊",
        "損失",
        "ダメージ",
        "災難",
        "不便",
        "不利益",
        "問題",
        "障害",
        "限界",
        "隔たり",
        "断絶",
        "対立",
        "争い",
        "戦い",
        "敗北",
        "葛藤",
        "競争",
        "緊張",
        "厳しさ",
        "厳格さ",
        "困難",
        "試練",
        "苦痛",
        "苦しみ"
    ],
    "smell": [
        "オッハー",
        "食べちゃいたいナ〜",
        "٩(ˊᗜˋ*)و",
        "だっタ",
        "心配だヨ",
        "オイシイ",
        "元気出さなきゃだネ",
        "ナンチャッテ",
    ],
}

texts_close = {
    "like" : 0.9,
    "smell": 0.7,
}

vectorian        = SentencePieceVectorian()
input_vectors    = vectorian.fit(input).vectors
np_input_vectors = np.array(input_vectors)
np_input_vector  = np.mean(np.array(input_vectors), axis=0).reshape(1, -1)

for key in texts.keys():
    for text in texts[key]:
        np_text_vectors = np.array(vectorian.fit(text).vectors)
        np_text_vector  = np.mean(np_text_vectors, axis=0).reshape(1, -1)

        if is_close(np_input_vector, np_text_vector, texts_close[key]):
            output = TweetKind[key.upper()]

print(output.value)
