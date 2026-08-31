<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

#[Signature('admin:create {--name= : Ім\'я адміністратора} {--email= : Email адміністратора} {--password= : Пароль}')]
#[Description('Створити нового адміністратора з роллю admin')]
class CreateAdmin extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        $name = $this->option('name') ?: $this->ask('Ім\'я');
        $email = $this->option('email') ?: $this->ask('Email');
        $password = $this->option('password') ?: $this->secret('Пароль');

        $validator = Validator::make(
            compact('name', 'email', 'password'),
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'string', 'min:8'],
            ]
        );

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        $user->assignRole('admin');

        $this->info("Адміністратора \"{$user->name}\" ({$user->email}) успішно створено.");

        return self::SUCCESS;
    }
}
