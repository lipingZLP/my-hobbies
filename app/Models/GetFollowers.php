<?php

namespace App\Models;

class GetFollowers
{
    public $followers = [];

    function __construct($dbData)
    {
        foreach ($dbData as $entry) {
            $follower = new Follower($entry);
            array_push($this->followers, $follower);
        }
    }
}

class Follower
{
    public $id;
    public $name;
    public $nickname;
    public $avatar;

    function __construct($dbData)
    {
        $this->id = $dbData->id;
        $this->name = $dbData->name;
        $this->nickname = $dbData->nickname;
        $this->avatar = $dbData->avatar;
    }
}
