<?php

namespace App\Repositories;

use App\Models\Admin\UsersList;
use App\Models\GetFollowers;
use App\Models\GetFollowing;
use Illuminate\Support\Facades\DB;
use App\Models\GetSingleUserHobbies;
use Illuminate\Database\QueryException;

class UsersRepository
{
    public function getInfoByUsername($username)
    {
        $userInfoSql = 'SELECT id, name, nickname, avatar,
            (SELECT COUNT(id) FROM followers WHERE user_id = u.id) as followers,
            (SELECT COUNT(id) FROM followers WHERE follower_id = u.id) as following
            FROM users u WHERE nickname = ?';

        $userInfoData = DB::selectOne($userInfoSql, [$username]);
        if (!isset($userInfoData)) {
            return null;
        }

        $hobbiesInfoSql = 'SELECT p.*,
            (SELECT COUNT(c.id) FROM comments c WHERE c.post_id = p.id) as commentsNb
            FROM posts p
            WHERE p.user_id = ? ORDER BY date DESC LIMIT 30';
        $hobbiesInfoData = DB::select($hobbiesInfoSql, [$userInfoData->id]);

        return new GetSingleUserHobbies($userInfoData, $hobbiesInfoData);
    }

    public function addFollower($userId, $followerId)
    {
        $countSql = 'SELECT COUNT(id) as count FROM followers WHERE user_id = ? AND follower_id = ?';
        $data = DB::selectOne($countSql, [$userId, $followerId]);
        if ($data->count > 0) {
            return false;
        }

        $sql = 'INSERT INTO followers(user_id, follower_id) VALUES (?, ?)';

        try {
            DB::insert($sql, [$userId, $followerId]);
            return true;
        } catch (QueryException $e) {
            return false;
        }
    }

    public function unfollow($userId, $followerId)
    {
        $sql = 'DELETE FROM followers WHERE user_id = ? AND follower_id = ?';
        $affectedRows = DB::delete($sql, [$userId, $followerId]);
        return $affectedRows > 0;
    }

    public function getFollowers($id)
    {
        $usersql = 'SELECT id, name, nickname, avatar FROM users WHERE id = ?';
        $userInfoData = DB::selectOne($usersql, [$id]);
        $sql = 'SELECT u.id, u.name, u.nickname, u.avatar
            FROM users u
            INNER JOIN followers f ON f.follower_id = u.id
            WHERE f.user_id = ?';
        $followersInfoData = DB::select($sql, [$id]);

        return new GetFollowers($userInfoData, $followersInfoData);
    }

    public function getFollowing($id)
    {
        $usersql = 'SELECT id, name, nickname, avatar FROM users WHERE id = ?';
        $userInfoData = DB::selectOne($usersql, [$id]);
        $sql = 'SELECT u.id, u.name, u.nickname, u.avatar
            FROM users u
            INNER JOIN followers f ON f.user_id = u.id
            WHERE f.follower_id = ?';
        $followingInfoData = DB::select($sql, [$id]);

        return new GetFollowing($userInfoData, $followingInfoData);
    }

    public function addComment($content, $userId, $postId)
    {
        $sql = 'INSERT INTO comments(content, user_id, post_id, date) VALUES (?, ?, ?, NOW())';

        try {
            DB::insert($sql, [$content, $userId, $postId]);
            return true;
        } catch (QueryException $e) {
            return false;
        }
    }

    public function getAllForAdmin()
    {
        $sql = 'SELECT id, name, nickname, email, avatar, is_admin FROM users';
        $usersData = DB::select($sql);

        return new UsersList($usersData);
    }
}
