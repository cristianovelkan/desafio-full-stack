<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $userRepository;
    protected $balanceService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        BalanceService $balanceService
    ) {
        $this->userRepository = $userRepository;
        $this->balanceService = $balanceService;
    }


    public function register(Request $request)
    {

        $input['password'] = Hash::make($request->password);
        $request->merge($input);

        $user = $this->userRepository->create($request);
        $this->balanceService->create($user->id);

        $data['token'] =  $user->createToken("{$request->email} Register")->plainTextToken;
        $data['user'] =  $this->userRepository->getById($user->id);

        return $data;
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = $this->userRepository->getById(Auth::user()->id);

            $data['user'] =  $user;
            $data['token'] =  $user->createToken("{$request->email} SignIn")->plainTextToken;

            return $data;
        } else {
            throw new \Exception('Unauthorized.', 401);
        }
    }
}
