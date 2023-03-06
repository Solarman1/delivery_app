<?php

namespace App\Repositories;

use App\Models\Category as CategoryModel;
use Illuminate\Database\Eloquent\Collection;

class Category
{
    public function getCategoryNameById(int $categoryId): Collection|array
    {
        return CategoryModel::query()
            ->select('name')
            ->where('id', $categoryId)
            ->get();
    }

    public function getCategories(): Collection
    {
        return CategoryModel::all();
    }
}
