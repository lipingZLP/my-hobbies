<?php

namespace App\Models;

class ShowComments
{
    public $comments = [];

    function __construct($dbData)
    {
        foreach ($dbData as $entry) {
            array_push($this->comments, new Comment($entry));
        }
    }
}

class Comment
{
    public $id;
    public $author;
    public $content;

    public function __construct($dbData)
    {
        $this->id = $dbData->cid;
        $this->author = new User($dbData);
        $this->content = $dbData->content;
    }
}
