<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;
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

    public function follow($id)
    {
        $user_id = 1; // TODO: CHANGE USER_ID VALUE

        if (!is_numeric($id)) {
            return response()->json(new Error('Invalid query'), 400);
        }

        if (!$this->repository->addFollower($id, $user_id)) {
            return response()->json(new Error('Invalid query'), 400);
        }

        return response('{}', 201);
    }

    public function unfollow($id)
    {
        $user_id = 1;

        if (!is_numeric($id)) {
            return response()->json(new Error('Invalid query'), 400);
        }

        if (!$this->repository->unfollow($id, $user_id)) {
            return response()->json(new Error('Not found'), 404);
        };

        return response('{}', 200);
    }

    public function getFollowers($id)
    {
        if (!is_numeric($id)) {
            return response()->json(new Error('Invalid query'), 400);
        }

        $data = $this->repository->getFollowers($id);
        return response()->json($data);
    }
}
