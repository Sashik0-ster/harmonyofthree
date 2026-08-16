<?php

namespace App\Http\Middleware;

use App\Models\LoginToken;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ConsumeTelegramLoginToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->query('login_token');

        if ($token) {
            $loginToken = LoginToken::where('token', $token)->first();

            if ($loginToken && !$loginToken->isExpired()) {
                Auth::login($loginToken->user);
                $request->session()->regenerate();
            }

            $loginToken?->delete(); // одноразове використання, незалежно від успіху

            // Прибираємо токен з URL, щоб він не лишався в історії/поверненнях
            return redirect($request->url());
        }

        return $next($request);
    }
}
