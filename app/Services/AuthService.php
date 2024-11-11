<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class AuthService
{

    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }


    public function register(Request $request)
    {

        $input['password'] = Hash::make($request->password);
        $request->merge($input);

        $user = $this->userRepository->create($request);

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