<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use AllowDynamicProperties;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Products;
use App\Services\Crud\CrudContext;
use App\Services\Crud\Strategies\ProductStrategy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

#[AllowDynamicProperties]
class ProductController extends Controller
{
    public function __construct(
        Products $productRepo
    ) {
        $this->productRepo = $productRepo;
        $this->crudContext = new CrudContext(new ProductStrategy());
    }

    public function index(): Collection
    {
        return $this->productRepo->getAllProducts();
    }

    public function store(CategoryRequest $requestForm): RedirectResponse
    {
        $this->crudContext->saveModel($requestForm);

        return redirect()->route('admin');
    }

    public function update(CategoryRequest $requestForm): RedirectResponse
    {
        $this->crudContext->updateModel($requestForm);

        return redirect()->route('admin');
    }

    public function delete(Request $request): RedirectResponse
    {
        $this->crudContext->deleteModel($request);

        return redirect()->route('admin');
    }
}
