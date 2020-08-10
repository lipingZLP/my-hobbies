<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class HobbiesRepository
{
    public function add($user_id, $categoryId, $title, $description, $rating)
    {
        $sql = 'INSERT INTO posts(category_id, title, description, rating, date, user_id) VALUES (?, ?, ?, ?, now(), ?)';
        DB::insert($sql, [$categoryId, $title, $description, $rating, $user_id]);
    }
}
