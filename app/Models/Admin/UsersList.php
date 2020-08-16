<?php

namespace App\Models\Admin;

use App\Models\User;

class UsersList
{
    public $users = [];

    function __construct($usersData)
    {
        foreach($usersData as $entry){
            array_push($this->users, new User($entry));
        }
    }
}
