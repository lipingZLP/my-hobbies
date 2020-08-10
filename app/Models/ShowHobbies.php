<?php

namespace App\Models;

class ShowHobbies
{
    public $hobbies = [];

    function __construct($dbData)
    {
        foreach($dbData as $entry) {
            array_push($this->hobbies, new Hobby($entry));
        }
    }
}

class Hobby
{
    public $id;
    public $title;
    public $date;
    public $author;
    public $category_id;
    public $description;
    public $rating;
    public $commentsNb;

    public function __construct($dbData)
    {
        $this->id = $dbData->pid;
        $this->title = $dbData->title;
        $this->date = $dbData->date;
        $this->author = new User($dbData);
        $this->category_id = $dbData->category_id;
        $this->description = $dbData->description;
        $this->rating = $dbData->rating;
        $this->commentsNb = $dbData->commentsNb;
    }
}
