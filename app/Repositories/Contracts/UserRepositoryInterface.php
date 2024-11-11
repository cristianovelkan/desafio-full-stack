<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function getAll($request);
    public function getById($id);
    public function create(Request $data);
    public function update($id, Request $data);
    public function delete($id);
}
