<?php

namespace App\Repositories;

use app\Models\Products\AdditionalProduct as AdditionalProductModal;
use Illuminate\Database\Eloquent\Collection;

class AdditionalProduct
{
    public function getAdditionalProductsByCategory(int $categoryId): Collection|array
    {
        return AdditionalProductModal::query()
            ->join('products', 'products.id', '=', 'additional_products.dop_product_id')
            ->select('additional_products.*', 'products.name')
            ->where('category_id', $categoryId)
            ->get()
            ->filter(fn($item) => [
                'productId'     => $item->product_id,
                'dopProductId'  => $item->dop_product_id,
                'name'          => $item->name
            ]);
    }
}
