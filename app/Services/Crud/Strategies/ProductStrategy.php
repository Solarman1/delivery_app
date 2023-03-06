<?php

namespace App\Services\Crud\Strategies;

use App\Models\Products\Product;
use App\Services\Crud\CrudInterface;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ProductStrategy implements CrudInterface
{
    use ImageTrait;

    public function create(Request $request)
    {
        $product = new Product();

        $categoryId = $request->input('categoryId');
        $name = $request->input('name');
        $price = $request->input('price');
        $weight = $request->input('weight');
        $description = $request->input('description');
        $image = $request->file('img');

        $imageName = $image->getClientOriginalName();
        $pathToImage = "uploads/$imageName";

        $this->saveAndResize($image);

        $product->setCategoryId($categoryId);
        $product->setName($name);
        $product->setPrice($price);
        $product->setWeight($weight);
        $product->setDescription($description);
        $product->setImage($pathToImage);

        $product->save();
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function update(Request $request): bool|int
    {

        $productId = $request->input('productEditId');

        $product = Product::query()->findOrFail($productId);

        $name = $request->input('name');
        $price = $request->input('price');
        $weight = $request->input('weight');
        $description = $request->input('description');

        $categoryId = session()->get('category_id');

        if ($request->has('img')) {

            $image = $request->file('img');
            $imageName = $image->getClientOriginalName();
            $oldImage = $request->input('imgEditHidden');

            $pathToImage = "uploads/$imageName";

            Storage::disk('public')->delete("$oldImage");

            $this->saveAndResize($image);

            return $product->update([
                'category_id' => $categoryId,
                'name' => $name,
                'price' => $price,
                'weight' => $weight,
                'description' => $description,
                'image' => "$pathToImage",
            ]);
        }

        return $product->update([
            'category_id' => $categoryId,
            'name' => $name,
            'price' => $price,
            'weight' => $weight,
            'description' => $description,
        ]);

    }

    public function delete(Request $request)
    {
        $productId = $request->input('productId');
        $oldImage   = $request->input('imageHiddenPost');

        Storage::disk('public')->delete("$oldImage");

        $article = Product::query()->findOrFail($productId);
        return $article->delete();
    }
}
