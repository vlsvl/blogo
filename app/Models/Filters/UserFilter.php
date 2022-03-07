<?php

namespace App\Models\Filters;

use Illuminate\Support\Facades\Date;

class UserFilter extends QueryFilter
{
    public function search(string $search)
    {
        return $this->builder->where('name', 'like', "%$search%");
    }

    public function created_at(array $created_at)
    {
        $from = Date::createFromFormat('Y-m-d\TH:i:s.uP', $created_at[0]);
        $to = Date::createFromFormat('Y-m-d\TH:i:s.uP', $created_at[1]);
        return $this->builder->whereBetween('created_at', [$from, $to]);
    }

    public function user_id(int $user_id)
    {
        return $this->builder->whereHas('user', $user_id);
    }
}
