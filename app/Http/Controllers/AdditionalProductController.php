<?php

namespace App\Http\Controllers;

use app\Models\Products\AdditionalProduct;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdditionalProductController extends Controller
{
    public function getAdditionalProducts(): Collection
    {
        return AdditionalProduct::all();
    }

    public function store(Request $requestForm): RedirectResponse
    {
        $productId      = $requestForm->input('productIdHidden');
        $dopsProductId  = $requestForm->input('productDopsSelector');
        $categoryId     = session()->get('categoriId');

        //die(var_dump($requestForm->input()));

        AdditionalProduct::create([
            'productId'     => $productId,
            'dopProductId'  => $dopsProductId,
        ]);

        return redirect()->to("/admin/category/{$categoryId}");
    }

    public function delete(Request $requestForm)
    {
        $additionalProductId   = $requestForm->input('dopProductHidden');
        $categoryId     = session()->get('categoriId');

        $article = AdditionalProduct::where('dopProductId', '=', $additionalProductId);

        $article->delete();

        return redirect()->to("/admin/category/{$categoryId}");
    }
}
