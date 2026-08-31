<?php

namespace App\Http\Controllers\HarmonyBlog\Pages\BottomNavigationPages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Repositories\Contracts\ProfileRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileSettingController extends Controller
{
    public function __construct(
        private readonly ProfileRepositoryInterface $profiles
    ) {
    }

    /**
     * Головна сторінка налаштувань профілю (GET /profilesetting)
     */
    public function index(): View|RedirectResponse
    {
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->route('register');
        }

        $user = $this->profiles->find($userId);

        return view('pages.bottomNavigationPages.profilesetting', ['user' => $user]);
    }

    /**
     * Відображення форми реєстрації (GET /register)
     */
    public function register(): View
    {
        return view('pages.auth.register');
    }

    public function login(): View
    {
        return view('pages.auth.login');
    }

    /**
     * Обробка форми реєстрації (POST /register)
     */
    public function registerUser(RegisterRequest $request): RedirectResponse
    {
        // Отримуємо очищені та перевірені дані з RegisterRequest
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'password' => Hash::make($data['password']),

        ]);

        // Автоматично логінимо новоствореного користувача
        Auth::login($user);

        return redirect()
            ->route('index');
    }

    public function loginUser(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('name', 'password');

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors(['name' => 'Невірний name або пароль'])
                ->onlyInput('name');
        }

        $request->session()->regenerate();

        return redirect()
            ->route('index')
            ->with('status', 'Вхід виконано успішно');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        // Скидаємо сесію та оновлюємо CSRF-токен для безпеки
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index');
    }
}
