<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;

class AuthController extends BaseController
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        try {
            return $this->sendResponse($this->authService->register($request), 'Registrado com sucesso.');
        } catch (\Exception $e) {
            return $this->sendError('Erro.', $e->getMessage());
        }
    }

    public function login(Request $request)
    {
        try {
            return $this->sendResponse($this->authService->login($request), 'Logado com sucesso.');
        } catch (\Exception $e) {
            return $this->sendError('Error.', $e->getMessage(), 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->sendResponse([], 'Você foi deslogado com sucesso.');
    }
}
