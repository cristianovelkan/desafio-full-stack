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


    public function increment(Request $request)
    {
        $balance = $this->balanceRepository->getByUserId(Auth::user()->id);
        $this->balanceRepository->increment($balance, $request->value);

        return $balance->fresh();
    }

    public function decrement(Request $request)
    {
        $balance = $this->balanceRepository->getByUserId(Auth::user()->id);
        $this->balanceRepository->decrement($balance, $request->value);

        return $balance->fresh();
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
