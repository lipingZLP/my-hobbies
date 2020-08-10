<?php

namespace App\Repositories;

use App\Models\GetFollowers;
use Illuminate\Support\Facades\DB;
use App\Models\GetSingleUserHobbies;
use Illuminate\Database\QueryException;

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

    public function addFollower($user_id, $follower_id)
    {
        $countSql = 'SELECT COUNT(id) as count FROM followers WHERE user_id = ? AND follower_id = ?';
        $data = DB::select($countSql, [$user_id, $follower_id])[0];
        if ($data->count > 0) {
            return false;
        }

        $sql = 'INSERT INTO followers (user_id, follower_id) VALUES (?, ?)';

        try {
            DB::insert($sql, [$user_id, $follower_id]);
            return true;
        } catch (QueryException $e) {
            return false;
        }
    }

    public function unfollow($user_id, $follower_id)
    {
        $sql = 'DELETE FROM followers WHERE user_id = ? AND follower_id = ?';
        $affectedRows = DB::delete($sql, [$user_id, $follower_id]);
        return $affectedRows > 0;
    }

    public function getFollowers($id)
    {
        $sql = 'SELECT u.id, u.name, u.nickname, u.avatar
            FROM users u
            INNER JOIN followers f ON f.follower_id = u.id
            WHERE f.user_id = ?';
        $followersInfoData = DB::select($sql, [$id]);

        return new GetFollowers($followersInfoData);
    }
}
