<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Requests\DepositRequest;
use App\Http\Requests\TransferRequest;
use App\Services\TransactionService;

class TransactionController extends BaseController
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index()
    {
        try {
            return $this->sendResponse($this->transactionService->getStatement(), 'Extrato obtido com sucesso.');
        } catch (\Exception $e) {
            return $this->sendError('Erro.', $e->getMessage());
        }
    }

    public function deposit(DepositRequest $request)
    {
        try {
            return $this->sendResponse($this->transactionService->deposit($request), 'Depósito efetuado com sucesso.');
        } catch (\Exception $e) {
            return $this->sendError('Erro.', $e->getMessage());
        }
    }

    public function transfer(TransferRequest $request)
    {
        try {
            return $this->sendResponse($this->transactionService->transfer($request), 'Transferência efetuada com sucesso.');
        } catch (\Exception $e) {
            return $this->sendError('Erro.', $e->getMessage());
        }
    }

    public function cancel($id)
    {
        try {
            return $this->sendResponse($this->transactionService->cancel($id), 'Transação cancelada com sucesso.');
        } catch (\Exception $e) {
            return $this->sendError('Erro.', $e->getMessage());
        }
    }
}
