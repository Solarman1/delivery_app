<?php

namespace App\Services\Crud;

use Illuminate\Http\Request;

interface CrudInterface
{
    public function create(Request $request);
    public function update(Request $request);
    public function delete(Request $request);
}
