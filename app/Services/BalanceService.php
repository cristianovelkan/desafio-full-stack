<?php

namespace App\Services;

use App\Repositories\Contracts\BalanceRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceService
{

    protected $balanceRepository;

    public function __construct(
        BalanceRepositoryInterface $balanceRepository
    ) {
        $this->balanceRepository = $balanceRepository;
    }


    public function increment(Request $request, $user)
    {
        $balance = $this->balanceRepository->getByUserId($user->id);
        $this->balanceRepository->increment($balance, $request->value);

        return $balance->fresh();
    }

    public function decrement(Request $request, $user)
    {
        $balance = $this->balanceRepository->getByUserId($user->id);
        $this->balanceRepository->decrement($balance, $request->value);

        return $balance->fresh();
    }

    public function check(Request $request)
    {
        $balance = $this->balanceRepository->getByUserId(Auth::user()->id);

        if ($balance->value < $request->value) {
            throw new \Exception('Saldo insuficiente.');
        }
    }

    public function getBalance()
    {
        return $this->balanceRepository->getByUserId(Auth::user()->id);
    }

    public function create($userId)
    {
        return $this->balanceRepository->create(new Request(['user_id' => $userId]));
    }
}
