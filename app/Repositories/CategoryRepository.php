<?php

namespace App\Repositories;

use App\Models\GetAllCategories;
use Illuminate\Support\Facades\DB;

class CategoryRepository
{
    public function getAll()
    {
        $sql = 'SELECT * FROM categories';
        $data = DB::select($sql);
        return new GetAllCategories($data);
    }
}
