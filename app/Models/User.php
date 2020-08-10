<?php

namespace App\Models;

class User
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
