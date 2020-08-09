<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class HobbiesRepository
{
    public function add($categoryId, $title, $description, $rating)
    {
        $sql = 'INSERT INTO posts(category_id, title, description, rating, date, user_id) VALUES (?, ?, ?, ?, now(), ?)';
        DB::insert($sql, [$categoryId, $title, $description, $rating, 1]); // TODO: CHANGE USER_ID VALUE
    }
}
