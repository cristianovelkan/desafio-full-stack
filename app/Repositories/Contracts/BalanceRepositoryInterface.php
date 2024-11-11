<?php

namespace App\Repositories\Contracts;

use App\Models\Balance;
use Illuminate\Http\Request;

interface BalanceRepositoryInterface
{
    public function getByUserId($id);
    public function create(Request $data);
    public function increment(Balance $balance, $value);
    public function decrement(Balance $balance, $value);
}
