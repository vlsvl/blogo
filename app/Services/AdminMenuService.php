<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class AdminMenuService
{
    private User $user;

    private array $menu = [
        [
            'type' => 'link',
            'route' => 'dashboard',
            'title' => 'dashboard',
        ],
        [
            'type' => 'collapse',
            'title' => 'Manage users',
            'collapsed' => true,
            'role' => ['admin'],
            'pages' => [
                [
                    'type' => 'link',
                    'route' => 'users.index',
                    'title' => 'users',
                ],
                [
                    'type' => 'link',
                    'route' => 'roles.index',
                    'title' => 'roles',
                ],
            ],
        ],
        [
            'type' => 'collapse',
            'title' => 'Posts',
            'collapsed' => true,
            'icon' => 'write',
            'pages' => [
                [
                    'type' => 'link',
                    'route' => 'posts.index',
                    'title' => 'posts',
                    'role' => ['admin', 'editor'],
                ],
                [
                    'type' => 'link',
                    'route' => 'comments.index',
                    'title' => 'comments',
                    'role' => ['admin', 'editor', 'user'],
                ],
            ],
        ],
    ];

    public function __construct(Request $request)
    {
        $this->user = $request->user();
    }

    public function getMenu(): array
    {
        $result = [];
        $this->iterate($this->menu, $result);
        return $result;
    }

    public function iterate($items, &$result)
    {
        foreach ($items as $item) {
            if ($this->checkRoleForItem($item)) {
                if (!empty($item['pages'])) {
                    $pages = [];
                    $this->iterate($item['pages'], $pages);
                    $item['pages'] = $pages;
                }
                $result[] = $item;
            }
        }
    }

    public function checkRoleForItem($item): bool
    {
        if (!empty($item['role']) && !in_array($this->user->role->name, $item['role'])) {
            return false;
        }
        return true;
    }
}
