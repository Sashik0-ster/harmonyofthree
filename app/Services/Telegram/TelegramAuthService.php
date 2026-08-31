<?php

namespace App\Services\Telegram;

class TelegramAuthService
{
    /**
     * Перевіряє підпис initData і повертає розпарсені дані, або null якщо підпис невалідний.
     */
    public function validate(string $initData): ?array
    {
        parse_str($initData, $data);

        if (!isset($data['hash']) || !isset($data['user'])) {
            return null;
        }

        $hash = $data['hash'];
        unset($data['hash']);

        ksort($data);

        $dataCheckArr = [];
        foreach ($data as $key => $value) {
            $dataCheckArr[] = $key . '=' . $value;
        }
        $dataCheckString = implode("\n", $dataCheckArr);

        $botToken = config('services.telegram.bot_token');
        $secretKey = hash_hmac('sha256', $botToken, 'WebAppData', true);
        $calculatedHash = hash_hmac('sha256', $dataCheckString, $secretKey);

        if (!hash_equals($calculatedHash, $hash)) {
            return null;
        }

        // Захист від застарілих initData (Telegram рекомендує ліміт ~1 день)
        $authDate = (int) ($data['auth_date'] ?? 0);
        if ($authDate === 0 || now()->timestamp - $authDate > 86400) {
            return null;
        }

        return $data;
    }
}
