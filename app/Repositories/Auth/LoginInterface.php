<?php

namespace App\Repositories\Auth;

interface LoginInterface
{

    public function create(): View;

    public function store(LoginRequest $request): RedirectResponse;

    public function destroy(Request $request): RedirectResponse;

}
