<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\GetSingleUserHobbies;

class UsersRepository
{
    public function getHobbiesById($id)
    {
        $userInfoSql = 'SELECT id, name, nickname, avatar,
            (SELECT COUNT(id) FROM followers WHERE user_id = ?) as followers,
            (SELECT COUNT(id) FROM followers WHERE follower_id = ?) as following
            FROM users WHERE id = ?';

        $userInfoData = DB::selectOne($userInfoSql, [$id, $id, $id]);

        $hobbiesInfoSql = 'SELECT p.*,
            (SELECT COUNT(c.id) FROM comments c WHERE c.post_id = p.id) as commentsNb
            FROM posts p
            WHERE p.user_id = ? ORDER BY date DESC LIMIT 30';
        $hobbiesInfoData = DB::select($hobbiesInfoSql, [$id]);

        if (!isset($userInfoData) || !isset($hobbiesInfoData)) {
            return null;
        }

        return new GetSingleUserHobbies($userInfoData, $hobbiesInfoData);
    }
}
