<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @OA\Info(title="Test Devio API", version="0.1")
     *
     * @OA\Get(
     *     path="/v1/products",
     *     summary="Retorna uma lista dos produtos",
     *     operationId="products",
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *         ref="#/components/schemas/Product"
     *     )
     * )
     */
    public function index()
    {
        try {
            return response()->json($this->productService->getAll(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * @OA\Get(
     *     path="/v1/search?q={q}",
     *     summary="Retorna uma lista dos produtos filtrados pelo parâmetro passado",
     *     operationId="search",
     *     @OA\Parameter(
     *         name="q",
     *         in="query",
     *         description="Parâemtro utilizado no filtro, pode ser o nome ou código do produto",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *         ref="#/components/schemas/Product"
     *     )
     * )
     */
    public function search(Request $request)
    {
        try {
            $term = $request->get('q');
            return response()->json($this->productService->search($term), Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
