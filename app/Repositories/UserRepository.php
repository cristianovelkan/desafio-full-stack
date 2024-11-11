<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserRepository implements UserRepositoryInterface
{

    protected $entity;

    public function __construct(User $user)
    {
        $this->entity = $user;
    }

    /**
     * Select all items
     * @return array
     */
    public function getAll($request)
    {
        return $this->entity->paginate($request->per_page ?? 10);
    }

    /**
     * Select by ID
     * @param int $id
     * @return object
     */
    public function getById($id)
    {
        return $this->entity->where('id', $id)->first();
    }

    /**
     * Create new item
     * @param UserRequest $user
     * @return object
     */
    public function create(Request $data)
    {
        $user = new User();
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = $data->password;
        $user->save();

        return $user;
    }

    /**
     * Update item
     * @param $id
     * @param array $item
     * @return object
     */
    public function update($id, Request $request)
    {
        $user = $this->entity->findOrFail($id);
        return $user->update($request->all());
    }

    /**
     * Delete item
     * @param object $item
     */
    public function delete($id)
    {
        $user = $this->entity->findOrFail($id);
        return $user->delete();
    }
}
