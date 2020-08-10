<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Repositories\HobbiesRepository;
use Illuminate\Http\Request;
use App\Models\Error;

class HobbiesApiController extends Controller
{
    protected $repository;

    public function __construct(HobbiesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function add(Request $request)
    {
        if (!$request->has('categoryId') ||
             !$request->has('title') ||
             !$request->has('description') ||
             !$request->has('rating')) {
            return response()->json(new Error('Invalid query'), 400);
        }

        $user_id = 1; // TODO: CHANGE USER_ID VALUE

        $categoryId = $request->input('categoryId');
        $title = $request->input('title');
        $description = $request->input('description');
        $rating = $request->input('rating');

        $this->repository->add($user_id, $categoryId, $title, $description, $rating);

        return response('{}', 201, ['Content-Type' => 'application/json']);
    }

    public function showHobbies()
    {
        $user_id = 1; // TODO: CHANGE USER_ID VALUE

        $data = $this->repository->showFollowingHobbies($user_id);
        return response()->json($data);
    }
}
