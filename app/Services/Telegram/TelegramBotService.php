<?php

namespace App\Services\Telegram;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class TelegramBotService
{

    protected string $token;
    protected string $apiUrl;


    public function __construct()
    {

        $this->token = (string) config('services.telegram.bot_token');
        $this->apiUrl = "https://api.telegram.org/bot{$this->token}/";

    }

    /**
     * Базовий виклик будь-якого методу Bot API.
     */

    protected function call(string $method, array $params = []): array
    {

        $response = Http::asJson()->post($this->apiUrl . $method, $params);

        if ($response->failed()) {
            Log::warning("Telegram API [{$method}] failed", [
                'params' => $params,
                'responce' => $response->body(),
            ]);
        }

        return $response->json() ?? [];

    }

    /**
     * Реєструє URL вебхука в Telegram.
     * Викликається один раз (через artisan-команду) при налаштуванні бота.
     */

    public function setWebhook(string $url): array
    {

        $params = [
            'url' => $url,
            'allowed_updates' => ['message', 'callback_query'],
        ];

        $secret = config('services.telegram.webhook_secret');

        if (filled($secret)) {
            $params['secret_token'] = $secret;
        }

        return $this->call('setWebhook', $params);

    }

    public function deleteWebhook(): array
    {

        return $this->call('deleteWebhook');

    }

    public function getWebhookInfo(): array
    {
        return $this->call('getWebhookInfo');
    }


    /**
     * Встановлює постійну кнопку меню (зліва від поля вводу),
     * яка одним тапом відкриває Mini App.
     *
     * Це і є механізм "застосунок відкривається відразу при вході в бота" —
     * кнопка з'являється автоматично щойно людина відкриває чат з ботом.
     */

    public function setMenuButtonToWebApp(string $webAppUrl, string $text = 'Відкрити'): array
    {

        return $this->call('setChatMenuButton', [
            'menu_button' => json_encode([
                'type' => 'web_app',
                'text' => $text,
                'web_app' => ['url' => $webAppUrl],
            ]),
        ]);

    }

    /**
     * Надсилає текстове повідомлення.
     */

    public function sendMessage(int|string $chatId, string $text, ?array $replyMarkup = null): array
    {

        $params = [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => 'HTML',
        ];

        if ($replyMarkup !== null) {
            $params['reply_markup'] = json_encode($replyMarkup);
        }

        return $this->call('sendMessage', $params);

    }

    /**
     * Надсилає повідомлення з inline-кнопкою, що відкриває Mini App.
     * Використовується як відповідь на /start — додатковий, "явний" вхід
     * в застосунок одразу в самому повідомленні (окрім Menu Button).
     */

    public function sendWebAppButton(int|string $chatId, string $webAppUrl, string $text, string $buttonText = 'Відкрити ЖИВА')
    {

        return $this->sendMessage($chatId, $text, [
            'inline_keyboard' => [
                [
                    ['text' => $buttonText, 'web_app' => ['url' => $webAppUrl]],
                ]
            ],
        ]);

    }



}
