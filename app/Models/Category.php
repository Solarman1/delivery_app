<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected string $name;
    protected string $image;

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }
}
