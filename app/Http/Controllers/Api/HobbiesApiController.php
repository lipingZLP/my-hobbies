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

        $categoryId = $request->input('categoryId');
        $title = $request->input('title');
        $description = $request->input('description');
        $rating = $request->input('rating');

        if (!isset($categoryId)) {
            return $this->error('You must specify a category.');
        }

        if (!$title || empty($title)) {
            return $this->error('You must specify a title.');
        }

        if (!$description || empty($description)) {
            return $this->error('You must specify a description.');
        }

        if (!isset($rating)) {
            return $this->error('You must specify a rating.');
        }

        $this->repository->add($user_id, $categoryId, $title, $description, $rating);

        return response('{}', 201, ['Content-Type' => 'application/json']);
    }

    public function showHobbies()
    {
        $user_id = Auth::id();

        $data = $this->repository->showFollowingHobbies($user_id);
        return response()->json($data);
    }

    public function getComments(Request $request, $id)
    {
        $page = $this->getPage($request);
        $data = $this->repository->getCommentsById($id, $page);
        return response()->json($data);
    }

    private function error($message) {
        return response()->json(new Error($message), 400);
    }
}
