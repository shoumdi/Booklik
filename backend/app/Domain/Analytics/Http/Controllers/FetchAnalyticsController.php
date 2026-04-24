<?php

namespace App\Domain\Analytics\Http\Controllers;

use App\Domain\Book\Models\Book;
use App\Domain\Community\Models\Community;
use App\Domain\User\Models\User;
use App\Shared\Http\Controllers\Controller;
use Core\AppRole;
use Core\SuccessJsonResponse;
use Illuminate\Http\Request;

class FetchAnalyticsController extends Controller
{
    public function __invoke()
    {
        return SuccessJsonResponse::make([
            'communities_count' => Community::count(),
            'books_count' => Book::count(),
            'users_count' => User::whereDoesntHave('roles', fn($q) => $q->where('name', AppRole::SUPER_ADMIN->value))->count()
        ], 200);
    }
}
