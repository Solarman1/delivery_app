<?php

namespace App\Services\Crud;

use AllowDynamicProperties;
use Illuminate\Http\Request;

#[AllowDynamicProperties]
class CrudContext
{
    public function __construct(CrudInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    public function setStrategy(CrudInterface $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function saveModel(Request $request)
    {
        return $this->strategy->create($request);
    }

    public function updateModel(Request $request)
    {
        return $this->strategy->update($request);
    }

    public function deleteModel(Request $request)
    {
        return $this->strategy->delete($request);
    }
}
