<?php

namespace App\Models;

class GetFollowing
{
    public $following = [];

    function __construct($dbData)
    {
        foreach ($dbData as $entry) {
            array_push($this->following, new User($entry));
        }
    }
}
