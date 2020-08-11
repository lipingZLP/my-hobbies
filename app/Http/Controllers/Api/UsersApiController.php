<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;
use App\Models\Error;
use Illuminate\Support\Facades\Auth;

class UsersApiController extends Controller
{
    protected $repository;

    public function __construct(UsersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getInfoByUsername($username)
    {
        $data = $this->repository->getInfoByUsername($username);

        if (!isset($data)) {
            return response()->json(new Error('Resource not found'), 404);
        }

        return response()->json($data);
    }

    public function follow($id)
    {
        $user_id = Auth::id();

        if (!is_numeric($id)) {
            return response()->json(new Error('Invalid query'), 400);
        }

        if (!$this->repository->addFollower($id, $user_id)) {
            return response()->json(new Error('Invalid query'), 400);
        }

        return response('{}', 201, ['Content-Type' => 'application/json']);
    }

    public function unfollow($id)
    {
        $user_id = Auth::id();

        if (!is_numeric($id)) {
            return response()->json(new Error('Invalid query'), 400);
        }

        if (!$this->repository->unfollow($id, $user_id)) {
            return response()->json(new Error('Not found'), 404);
        };

        return response('{}', 200, ['Content-Type' => 'application/json']);
    }

    public function getFollowers($id)
    {
        if (!is_numeric($id)) {
            return response()->json(new Error('Invalid query'), 400);
        }

        $data = $this->repository->getFollowers($id);
        return response()->json($data);
    }

    public function getFollowing($id)
    {
        if (!is_numeric($id)) {
            return response()->json(new Error('Invalid query'), 400);
        }

        $data = $this->repository->getFollowing($id);
        return response()->json($data);
    }

    public function addComment(Request $request, $id)
    {
        $user_id = Auth::id();

        if (!is_numeric($id)) {
            return response()->json(new Error('Invalid query'), 400);
        }

        $content = $request->input('content');

        if (!$this->repository->addComment($content, $user_id, $id)) {
            return response()->json(new Error('Invalid query'), 400);
        }

        return response('{}', 201, ['Content-Type' => 'application/json']);
    }
}
