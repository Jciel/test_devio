<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductService
{
    private Product $productModel;
    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    public function getAll()
    {
        return $this->productModel->all();
    }

    public function search(string $term)
    {
        return $this->productModel
            ->where('name', 'like', "%$term%")
            ->orWhere('code', 'like', "%$term%")
            ->get();
    }
}
