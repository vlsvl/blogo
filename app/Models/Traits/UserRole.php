<?php

namespace App\Models\Traits;

use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserRole
{
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function assignRole($name): bool
    {
        $this->role()
            ->associate(
                Role::where('name', $name)->firstOrFail()
            );
        return $this->save();
    }

    public function isAdmin(): bool
    {
        return $this->role->name === Role::ROLE_ADMIN;
    }

    public function isEditor(): bool
    {
        return $this->role->name === Role::ROLE_EDITOR;
    }

    public function isUser(): bool
    {
        return $this->role->name === Role::ROLE_USER;
    }
}
