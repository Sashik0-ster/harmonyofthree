<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Telegram\TelegramAuthService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class TelegramAuthController extends Controller
{
    public function __construct(protected TelegramAuthService $telegramAuth)
    {
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'initData' => ['required', 'string'],
        ]);

        $data = $this->telegramAuth->validate($request->input('initData'));

        if ($data === null) {
            abort(403, 'Недійсні дані Telegram.');
        }

        $tgUser = json_decode($data['user'], true);

        $user = User::updateOrCreate(
            ['telegram_id' => $tgUser['id']],
            [
                'name' => trim(($tgUser['first_name'] ?? '') . ' ' . ($tgUser['last_name'] ?? '')) ?: 'Користувач',
                'telegram_username' => $tgUser['username'] ?? null,
            ]
        );

        Auth::login($user, remember: true);

        return redirect()->route('app.home');
    }
}
