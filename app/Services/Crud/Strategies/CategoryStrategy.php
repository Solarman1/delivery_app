<?php

namespace App\Services\Crud\Strategies;

use App\Models\Category;
use App\Services\Crud\CrudInterface;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryStrategy implements CrudInterface
{
    use ImageTrait;

    public function create(Request $request): bool
    {
        $category = new Category();
        $name = $request->input('categoryName');
        $image = $request->file('img');

        $pathToImage = $image->getClientOriginalName();

        $this->saveAndResize($image);

        $category->setImage($name);
        $category->setImage($pathToImage);

        return $category->save();
    }

    public function update(Request $request): bool|int
    {
        $categoryId = $request->input('categoryId');
        $categoryName = $request->input('categoryName');
        $category = Category::query()->findOrFail($categoryId);

        if ($request->has('img')) {
            $image = $request->file('img');
            $imageName = $image->getClientOriginalName();
            $oldImage = $request->input('imgEditHidden');

            Storage::disk('category')->delete("$oldImage");

            $this->saveAndResize($image);

            return $category->update([
                'name' => $categoryName,
                'image' => $imageName,
            ]);
        }

        return $category->update([
            'name' => $categoryName,
        ]);
    }

    public function delete(Request $request): bool|null
    {
        $categoryId = $request->input('categoryId');

        $article = Category::query()->findOrFail($categoryId);

        return $article->delete();
    }
}
