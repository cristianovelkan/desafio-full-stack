<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\BalanceService;

class BalanceController extends BaseController
{
    protected $balanceService;

    public function __construct(BalanceService $balanceService)
    {
        $this->balanceService = $balanceService;
    }

    public function show()
    {
        try {
            return $this->sendResponse($this->balanceService->getBalance(), 'Saldo obtido com sucesso.');
        } catch (\Exception $e) {
            return $this->sendError('Erro.', $e->getMessage());
        }
    }
}
