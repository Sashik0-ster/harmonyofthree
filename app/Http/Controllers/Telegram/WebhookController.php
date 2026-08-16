<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use App\Models\LoginToken;
use App\Models\User;
use App\Services\Telegram\TelegramBotService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class WebhookController extends Controller
{
    public function __construct(protected TelegramBotService $bot)
    {
        //
    }

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
        $from = $message['from'] ?? null;

        if ($chatId === null || $from === null) {
            return;
        }

        if ($text === '/start') {
            $this->handleStart($chatId, $from);
            return;
        }

        $this->bot->sendMessage(
            $chatId,
            'Скористайся кнопкою меню (☰ зліва від поля вводу) або /start, щоб відкрити застосунок.'
        );
    }

    protected function handleStart(int $chatId, array $from): void
    {
        $user = User::firstOrCreate(
            ['telegram_id' => $from['id']],
            [
                'name' => trim(($from['first_name'] ?? '') . ' ' . ($from['last_name'] ?? '')) ?: 'Користувач',
                'telegram_username' => $from['username'] ?? null,
            ]
        );

        // Оновлюємо username, якщо змінився
        if (($from['username'] ?? null) !== $user->telegram_username) {
            $user->update(['telegram_username' => $from['username'] ?? null]);
        }

        // Одноразовий короткоживучий токен для входу
        $loginToken = LoginToken::create([
            'user_id' => $user->id,
            'token' => Str::random(48),
            'expires_at' => now()->addMinutes(5),
        ]);

        $webAppUrl = config('services.telegram.webapp_url') . '?login_token=' . $loginToken->token;

        $this->bot->sendWebAppButton(
            chatId: $chatId,
            webAppUrl: $webAppUrl,
            text: "Привіт! 🌿\n\nЖИВА — простір для гармонії душі, тіла і розуму.\n\nНатисни кнопку нижче, щоб відкрити застосунок.",
        );
    }

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
