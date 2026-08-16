<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\ProfileRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProfileRepository implements ProfileRepositoryInterface
{
    public function find(int $userId): User
    {
        return User::findOrFail($userId);
    }

    public function update(User $user, array $data): User
    {
        $user->name = $data['name'];

        if (isset($data['avatar']) && $data['avatar'] instanceof UploadedFile) {
            $this->replaceAvatar($user, $data['avatar']);
        }

        $user->save();

        return $user->fresh();
    }

    private function replaceAvatar(User $user, UploadedFile $avatar): void
    {
        if ($user->avatar_path) {
            Storage::delete($user->avatar_path);
        }

        $user->avatar_path = $avatar->store('avatars');
    }
}
