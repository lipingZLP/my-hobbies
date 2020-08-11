<?php

namespace App\Repositories;

use App\Models\ShowHobbies;
use App\Models\ShowComments;
use Illuminate\Support\Facades\DB;

class HobbiesRepository
{
    public function add($user_id, $categoryId, $title, $description, $rating)
    {
        $sql = 'INSERT INTO posts(category_id, title, description, rating, date, user_id) VALUES (?, ?, ?, ?, now(), ?)';
        DB::insert($sql, [$categoryId, $title, $description, $rating, $user_id]);
    }

    public function showFollowingHobbies($id)
    {
        $sql = 'SELECT p.id as pid, p.title, p.description, p.rating, p.date, p.category_id,
            (SELECT COUNT(c.id) FROM comments c WHERE c.post_id = p.id) as commentsNb,
            u.id, u.name, u.nickname, u.avatar
            FROM posts p
            INNER JOIN users u ON p.user_id = u.id
            WHERE p.user_id IN (SELECT user_id FROM followers WHERE follower_id = ?)
            ORDER BY date DESC LIMIT 30';

        $ShowHobbiesData = DB::select($sql, [$id]);

        return new ShowHobbies($ShowHobbiesData);
    }

    public function getCommentsById($id)
    {
        $sql = 'SELECT c.id as cid, c.content,
            u.id, u.name, u.nickname, u.avatar
            FROM comments c
            INNER JOIN users u ON c.user_id = u.id
            WHERE c.post_id = ?
            ORDER BY c.id DESC';

        $commentsData = DB::select($sql, [$id]);

        return new ShowComments($commentsData);
    }
}
