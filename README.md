<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://infidea.id/static/media/Logo.6b197990a0df4f5f6f9c.webp" width="400" alt="Laravel Logo"></a></p>

## About Project

This is a mini Backend QnA project from PT Rekayasa Teknologi Cerdas (Infidea)

## Tech Stack

Laravel 11

## How to Cloning

1. Cloning `git clone https://github.com/SulthanRaghib/qna-backend.git` and `cd qna-backend` on your terminal
2. Run `composer install` on your cmd or terminal
3. Copy `.env.example` file then paste file `.env` on the root folder
4. Open your `.env` file and change the database name (`DB_DATABASE`) to whatever you have, username (`DB_USERNAME`) and password (`DB_PASSWORD`) field correspond to your configuration.
5. Run `php artisan key:generate`
6. Run `php artisan migrate`
7. Run `php artisan db:seed`
8. Run `php artisan serve`

## Sweet Alert

https://realrashid.github.io/sweet-alert/install

## Websocket - Broadcasting with Laravel Reverb

1. run `php artisan serve`
2. run `php artisan reverb:start`
3. run `php artisan queue:work`
