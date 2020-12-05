## GO CARES WEB ADMIN & API

Project dari team SMKN 8 Semarang yang dibuat menggunakan Laravel 7 untuk membantu Jurusan Care Giver yang sedang berkembang di Indonesia, karena susahnya bertatap muka di masa pandemi.

## Server Requirements

- PHP >= 7.3
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Installation

    composer install

rename " .env.example " menjadi " .env " , buka file " .env " tadi kalibrasikan dengan database localmu pada bagian
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
jika sudah lalu save.

    php artisan key:generate

    php artisan migrate

    php artisan db:seed

    php artisan serve
