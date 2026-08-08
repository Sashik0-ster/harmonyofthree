<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use App\Services\Telegram\TelegramBotService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;


class WebhookController extends Controller
{

    public function __construct(protected TelegramBotService $bot)
    {
        //
    }


    /**
     * Приймає всі вхідні оновлення від Telegram (POST на /telegram/webhook).
     * Секретний токен у query/header захищає роут від сторонніх запитів.
     */

    public function handle(Request $request): Response
    {

        $this->verifySecret($request);

        $update = $request->all();

        Log::info('Telegram update', $update);

        $message = $update['message'] ?? null;

        if ($message !== null) {
            $this->handleMessage($message);
        }

        return response()->noContent();

    }

    protected function handleMessage(array $message): void
    {
        $chatId = $message['chat']['id'] ?? null;
        $text = trim($message['text'] ?? '');

        if ($chatId === null) {
            return;
        }

        if ($text === '/start') {

            $this->bot->sendWebAppButton(
                chatId: $chatId,
                webAppUrl: config('services.telegram.webapp_url'),
                text: "Привіт! 🌿\n\nЖИВА — простір для гармонії душі, тіла і розуму.\n\nНатисни кнопку нижче, щоб відкрити застосунок.",
            );
            return;
        }

        // Будь-яке інше повідомлення — просто нагадуємо про кнопку меню.
        $this->bot->sendMessage(
            $chatId,
            'Скористайся кнопкою меню (☰ зліва від поля вводу) або /start, щоб відкрити застосунок.'
        );

    }

    /**
     * Telegram дозволяє задати секретний токен при setWebhook (secret_token),
     * який він потім надсилає в заголовку X-Telegram-Bot-Api-Secret-Token.
     * Це захищає вебхук від підробних запитів ззовні.
     */
    protected function verifySecret(Request $request): void
    {
        $expected = config('services.telegram.webhook_secret');

        if (blank($expected)) {
            return;
        }

        $provided = $request->header('X-Telegram-Bot-Api-Secret-Token');

        abort_if($provided !== $expected, 403, 'Invalid webhook secret');
    }

}
