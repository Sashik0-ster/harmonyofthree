<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'telegram' => [
        // Токен від @BotFather — тільки в .env, ніколи в коді/репозиторії.
        'bot_token' => env('TELEGRAM_BOT_TOKEN'),

        // Публічний HTTPS-URL, куди Telegram надсилатиме оновлення.
        'webhook_url' => env('TELEGRAM_WEBHOOK_URL'),

        // Довільний секретний рядок для перевірки заголовка вебхука.
        'webhook_secret' => env('TELEGRAM_WEBHOOK_SECRET'),

        // URL самого застосунку (Mini App), який відкриває кнопка меню.
        'webapp_url' => env('TELEGRAM_WEBAPP_URL'),
    ],

];
