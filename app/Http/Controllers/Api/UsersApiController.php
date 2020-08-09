<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Repositories\UsersRepository;
use App\Models\Error;

class UsersApiController extends Controller
{
    protected $repository;

    public function __construct(UsersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getHobbiesById($id)
    {
        if (!is_numeric($id)) {
            return response()->json(new Error('Invalid query'), 400);
        }

        $data = $this->repository->getHobbiesById($id);

        if (!isset($data)) {
            return response()->json(new Error('Resource not found'), 404);
        }

        return response()->json($data);
    }
}
