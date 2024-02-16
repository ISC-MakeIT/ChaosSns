#!/bin/bash

main() {
    composer install

    if [ ! -f ./.env ]; then
        cp .env.example .env
        php artisan key:gen
        echo "[WARN] .env file not found. please get .env file from admin."
    fi
}

main