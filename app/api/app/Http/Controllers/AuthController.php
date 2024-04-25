<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\UsersService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private  UsersService $usersService;

    /**
     * @param UsersService $usersService
     */
    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }


    public function register(RegisterRequest $request)
    {
        return $this->usersService->create($request->only(['name', 'email', 'country', 'phone', 'idd']));
    }
}
