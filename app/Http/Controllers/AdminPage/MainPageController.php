<?php

namespace App\Http\Controllers\AdminPage;

use App\Repositories\AdditionalProduct;
use App\Repositories\Category;
use App\Repositories\Products;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

#[\AllowDynamicProperties]
class MainPageController
{
    public function __construct(
        AdditionalProduct $additionalProductRepository,
        Category $categoryRepository,
        Products $productRepository
    ) {
        $this->additionalProductRepository = $additionalProductRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function index(): View|Factory|Application
    {
        $categories = $this->categoryRepository->getCategories();

        return view('main', compact('categories'));
    }

    public function mainPageInfo(int $categoryId): View|Factory|Application
    {
        $categories = $this->categoryRepository->getCategories();
        $categoryName = $this->categoryRepository->getCategoryNameById($categoryId);
        $additionalProductsResult = $this->additionalProductRepository->getAdditionalProductsByCategory($categoryId);
        $products = $this->productRepository->getProductsByCategory($categoryId);

        session()->put('category_id', "$categoryId");

        return view('categoryProductsAdmin',
            compact('categories', 'categoryName', 'products', 'additionalProductsResult'));
    }

    public function getProducts(int $categoryId): false|string
    {
        $products = $this->productRepository->getProductsByCategory($categoryId);

        return json_encode($products);
    }
}
