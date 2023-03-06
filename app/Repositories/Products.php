<?php

namespace App\Repositories;

use App\Models\Products\Product as ProductModel;
use Illuminate\Database\Eloquent\Collection;

class Products
{
    public function getProductsByCategory(int $categoryId): Collection|array
    {
        return ProductModel::query()
            ->where('category_id', $categoryId)
            ->get();
    }

    public function getAllProducts(): Collection
    {
        return ProductModel::all();
    }
}
