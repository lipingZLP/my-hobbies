<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Repositories\HobbiesRepository;
use Illuminate\Http\Request;
use App\Models\Error;
use Illuminate\Support\Facades\Auth;

class HobbiesApiController extends Controller
{
    protected $repository;

    public function __construct(HobbiesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function add(Request $request)
    {
        $user_id = Auth::id();

        if (!$request->has('categoryId') ||
             !$request->has('title') ||
             !$request->has('description') ||
             !$request->has('rating')) {
            return response()->json(new Error('Invalid query'), 400);
        }

        $categoryId = $request->input('categoryId');
        $title = $request->input('title');
        $description = $request->input('description');
        $rating = $request->input('rating');

        $this->repository->add($user_id, $categoryId, $title, $description, $rating);

        return response('{}', 201, ['Content-Type' => 'application/json']);
    }

    public function showHobbies()
    {
        $user_id = Auth::id();

        $data = $this->repository->showFollowingHobbies($user_id);
        return response()->json($data);
    }

    public function getComments($id)
    {
        $data = $this->repository->getCommentsById($id);
        return response()->json($data);
    }
}
