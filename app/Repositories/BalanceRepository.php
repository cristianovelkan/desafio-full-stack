<?php

namespace App\Repositories;

use App\Models\Balance;
use App\Repositories\Contracts\BalanceRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BalanceRepository implements BalanceRepositoryInterface
{

    protected $entity;

    public function __construct(Balance $balance)
    {
        $this->entity = $balance;
    }

    public function getByUserId($id)
    {
        try {
            return $this->entity->where('user_id', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return $this->create(new Request(['user_id' => $id]));
        } catch (\Exception $e) {
            throw new \Exception('Erro ao buscar saldo.');
        }
    }

    public function create(Request $data)
    {
        $balance = new Balance();
        $balance->user_id = $data->user_id;
        $balance->value = 0;
        $balance->save();

        return $balance;
    }

    public function increment(Balance $balance, $value)
    {
        $balance->value += $value;
        $balance->save();
    }

    public function decrement(Balance $balance, $value)
    {
        $balance->value -= $value;
        $balance->save();
    }
}
