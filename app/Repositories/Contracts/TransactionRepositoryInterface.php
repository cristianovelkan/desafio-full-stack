<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Http\Request;

interface TransactionRepositoryInterface
{
    public function getByUserId($id);
    public function getById($id);
    public function deposit(Request $request);
    public function transactionIn(Request $request, User $userTo);
    public function transactionOut(Request $request, User $userTo);
}
