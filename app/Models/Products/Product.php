<?php

namespace app\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected int $category_id;
    protected string $name;
    protected float $price;
    protected string $weight;
    protected string $description;
    protected string $image;


    public function setCategoryId(int $categoryId)
    {
        $this->category_id = $categoryId;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    public function setWeight(string $weight)
    {
        $this->weight = $weight;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }
}
