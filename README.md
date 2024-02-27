# ChaosSns

色んな意味でうるさいSNS。取り扱い注意  

- NextJS (フロントエンド)
- Laravel (バックエンド)

を使用しています


# 開発環境の立て方
フロントエンドとバックエンドともに `.env` は `.env.example` からコピーして必要に応じてそれぞれ設定してください。
```
docker compose up -d

docker compose exec -it backend /bin/bash

php artisan migrate:fresh

php artisan db:seed
```
