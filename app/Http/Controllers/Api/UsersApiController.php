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

    public function getById($id)
    {
        if (!is_numeric($id)) {
            return response()->json(new Error('Invalid query'), 400);
        }

        $data = $this->repository->getById($id);
        return response()->json($data);
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
        $userId = Auth::id();

        if (!is_numeric($id)) {
            return response()->json(new Error('Invalid query'), 400);
        }

        if (!$this->repository->addFollower($id, $userId)) {
            return response()->json(new Error('Invalid query'), 400);
        }

        return response('{}', 201, ['Content-Type' => 'application/json']);
    }

    public function unfollow($id)
    {
        $userId = Auth::id();

        if (!is_numeric($id)) {
            return response()->json(new Error('Invalid query'), 400);
        }

        if (!$this->repository->unfollow($id, $userId)) {
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
        $userId = Auth::id();

        if (!is_numeric($id)) {
            return response()->json(new Error('Invalid query'), 400);
        }

        $content = $request->input('content');

        if (!$this->repository->addComment($content, $userId, $id)) {
            return response()->json(new Error('Invalid query'), 400);
        }

        return response('{}', 201, ['Content-Type' => 'application/json']);
    }

    public function getAllForAdmin()
    {
        $data = $this->repository->getAllForAdmin();
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $username = $request->input('nickname');

        if (!preg_match("/^[A-Za-z0-9-_]{1,15}$/", $username)) {
            return response()->json(new Error('The username may only contain letters, numbers, dashes and underscores and may not be greater than 15 characters.'), 400);
        }

        $email = $request->input('email');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(new Error('Invalid email'), 400);
        }

        $password = $request->input('password');
        if ($password != null && strlen($password) < 8) {
            return response()->json(new Error('The password must be at least 8 characters.'), 400);
        }
        $avatar = $request->input('avatar');

        $isAdmin = $request->input('is_admin');

        if (!$this->repository->update($name, $username, $email, $password, $avatar, $isAdmin, $id)) {
            return response()->json(new Error('Invalid query'), 400);
        };

        return response('{}', 200, ['Content-Type' => 'application/json']);
    }

    public function delete($id)
    {
        $userId = Auth::id();

        if ($id == $userId) {
            return response()->json(new Error('You are not allowed to delete yourself.'), 400);
        }

        $success = $this->repository->delete($id);
        if (!$success) {
            return response()->json(new Error('Error deleting user ' . $id), 400);
        }

        return response('{}', 200, ['Content-Type' => 'application/json']);
    }
}
