<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display registration page.
     *
     * Registration is disabled.
     */
    public function create(): View
    {
        abort(404);
    }

    /**
     * Registration is disabled.
     */
    public function store(): RedirectResponse
    {
        abort(404);
    }
}