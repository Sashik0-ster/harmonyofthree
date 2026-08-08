<?php

namespace App\Console\Commands;

use App\Services\Telegram\TelegramBotService;
use Illuminate\Console\Command;

/**
 * Одноразова команда налаштування бота:
 * php artisan telegram:setup
 *
 * Реєструє webhook і встановлює Menu Button, який відкриває Mini App
 * одразу при вході в чат з ботом.
 */
class TelegramSetup extends Command
{
    protected $signature = 'telegram:setup';
    protected $description = 'Реєструє webhook і Menu Button (Mini App) для Telegram-бота';

    public function handle(TelegramBotService $bot): int
    {
        $webhookUrl = config('services.telegram.webhook_url');
        $webAppUrl = config('services.telegram.webapp_url');

        if (blank($webhookUrl) || blank($webAppUrl)) {
            $this->error('TELEGRAM_WEBHOOK_URL або TELEGRAM_WEBAPP_URL не задані в .env');

            return self::FAILURE;
        }

        $this->info("Встановлюю webhook: {$webhookUrl}");
        $webhookResult = $bot->setWebhook($webhookUrl);
        $this->line(json_encode($webhookResult, JSON_UNESCAPED_UNICODE));

        $this->info("Встановлюю Menu Button на: {$webAppUrl}");
        $menuResult = $bot->setMenuButtonToWebApp($webAppUrl, 'Відкрити ЖИВА');
        $this->line(json_encode($menuResult, JSON_UNESCAPED_UNICODE));

        if (($webhookResult['ok'] ?? false) && ($menuResult['ok'] ?? false)) {
            $this->info('Готово! Відкрий бота в Telegram — кнопка меню вже має вести в застосунок.');

            return self::SUCCESS;
        }

        $this->warn('Щось пішло не так — перевір відповіді Telegram вище.');

        return self::FAILURE;
    }
}
