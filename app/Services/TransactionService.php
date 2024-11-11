<?php

namespace App\Services;

use App\Enum\EnumCategory;
use App\Enum\EnumStatus;
use App\Http\Resources\TransactionResource;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Doctrine\Common\Annotations\Annotation\Enum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionService
{

    protected $transactionRepository;
    protected $balanceService;
    protected $userRepository;

    public function __construct(
        TransactionRepositoryInterface $transactionRepository,
        UserRepository $userRepository,
        BalanceService $balanceService,
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;
        $this->balanceService = $balanceService;
    }

    public function getStatement()
    {
        $transactions = $this->transactionRepository->getByUserId(Auth::user()->id);
        return TransactionResource::collection($transactions);
    }

    public function deposit(Request $request)
    {
        DB::beginTransaction();
        try {
            $transaction = $this->transactionRepository->deposit($request);
            $this->balanceService->increment($request, Auth::user());
            DB::commit();
            return TransactionResource::make($transaction);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Erro ao depositar.');
        }
    }

    public function transfer(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->balanceService->check($request);

            $userTo = $this->userRepository->getById($request->user_id);

            $transactionIn = $this->transactionRepository->transactionOut($request, $userTo);

            if ($request->date && $request->date == Carbon::now()->format('Y-m-d')) {
                $this->balanceService->decrement($request, Auth::user());

                $this->transactionRepository->transactionIn($request, $userTo);
                $this->balanceService->increment($request, $userTo);
            }

            DB::commit();

            return TransactionResource::make($transactionIn);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Erro ao transferir. ' . $e->getMessage());
        }
    }

    public function cancel($id)
    {
        try {
            $transaction = $this->transactionRepository->getById($id);

            if (in_array($transaction->status, [EnumStatus::COMPLETED, EnumStatus::CANCELED])) {
                throw new \Exception('Transação já completada e não pode ser cancelada.');
            }

            if ($transaction->category == EnumCategory::DEPOSIT) {
                throw new \Exception('Depósito não pode ser cancelado.');
            }

            $transaction->status = EnumStatus::CANCELED;
            $transaction->save();
        } catch (\Exception $e) {
            throw new \Exception('Erro ao cancelar. ' . $e->getMessage());
        }
    }
}
