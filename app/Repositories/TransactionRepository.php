<?php

namespace App\Repositories;

use App\Enum\EnumCategory;
use App\Enum\EnumStatus;
use App\Enum\EnumType;
use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionRepository implements TransactionRepositoryInterface
{

    protected $entity;

    public function __construct(Transaction $transaction)
    {
        $this->entity = $transaction;
    }

    public function getByUserId($id)
    {
        try {
            return $this->entity->where('user_id', $id)
                ->orderBy('created_at', 'desc')
                ->paginate($request->per_page ?? 10);
        } catch (\Exception $e) {
            throw new \Exception('Erro ao buscar extrato.');
        }
    }

    public function getById($id)
    {
        try {
            return $this->entity->findOrFail($id);
        } catch (\Exception $e) {
            throw new \Exception('Erro ao buscar transação.');
        }
    }

    public function deposit(Request $request)
    {
        try {
            $transaction = $this->entity->create([
                'payer_id' => $request->user()->id,
                'user_id' => $request->user()->id,
                'type' => EnumType::IN,
                'category' => EnumCategory::DEPOSIT,
                'status' => EnumStatus::COMPLETED,
                'value' => $request->value,
                'due_date' => now(),
                'description' => $request->description ?? 'Depósito em conta.',
            ]);

            return $transaction;
        } catch (\Exception $e) {
            throw new \Exception('Erro ao depositar.');
        }
    }

    public function transactionOut(Request $request, $userTo)
    {
        try {
            $transaction = $this->entity->create([
                'payer_id' => $request->user()->id,
                'user_id' => $request->user()->id,
                'type' => EnumType::OUT,
                'category' => EnumCategory::TRANSFER,
                'due_date' => $request->date ?? now(),
                'status' => Carbon::parse($request->date)->gt(today()) ? EnumStatus::PENDING : EnumStatus::COMPLETED,
                'value' => $request->value,
                'description' => 'Transferência para conta de ' . $userTo->name,
            ]);

            return $transaction;
        } catch (\Exception $e) {
            throw new \Exception('Erro ao transferir.');
        }
    }

    public function transactionIn(Request $request, $userTo)
    {
        try {
            $transaction = $this->entity->create([
                'payer_id' => $request->user()->id,
                'user_id' => $userTo->id,
                'type' => EnumType::IN,
                'category' => EnumCategory::TRANSFER,
                'due_date' => now(),
                'status' => EnumStatus::COMPLETED,
                'value' => $request->value,
                'description' => 'Transferência recebida de ' . $request->user()->name,
            ]);

            return $transaction;
        } catch (\Exception $e) {
            throw new \Exception('Erro ao transferir.');
        }
    }
}
