<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @OA\Get(
     *     path="/v1/order",
     *     summary="Retorna uma lista dos Pedidos",
     *     operationId="order",
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/Order")
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json($this->orderService->getAll(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * @OA\Get(
     *     path="/v1/order/todo",
     *     summary="Retorna uma lista dos Pedidos com status 'a fazer'",
     *     operationId="todo",
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/Order"),
     *     )
     * )
     */
    public function getOrderToDo(): JsonResponse
    {
        try {
            return response()->json($this->orderService->getOrderToDo(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * @OA\Get(
     *     path="/v1/order/done",
     *     summary="Retorna uma lista dos Pedidos com status 'pronto'",
     *     operationId="done",
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/Order"),
     *     )
     * )
     */
    public function getOrderDone(): JsonResponse
    {
        try {
            return response()->json($this->orderService->getOrderDone(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * @OA\Patch(
     *     path="/v1/order/{id}/finalize-order",
     *     summary="Finaliza um pedido atualizando seu status para 'pronto'",
     *     operationId="finalizeOrder",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id do pedido a ser finalizado",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/Order")
     *     )
     * )
     */
    public function finalizeOrder(string $id): JsonResponse
    {
        try {
            return response()->json($this->orderService->finalizeOrder($id), Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * @OA\Patch(
     *     path="/v1/order/{id}/add-product",
     *     summary="Adiciona um novo produto a um pedido",
     *     operationId="addProduct",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id do pedido a ser adicionado novo produto",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         description="product_id",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/Order")
     *     )
     * )
     */
    public function addProduct(string $id, Request $request)
    {
        try {
            $product_id = $request->get('product_id');
            return response()->json($this->orderService->addProduct($id, $product_id), Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * @OA\Patch(
     *     path="/v1/order/{id}/remove-product",
     *     summary="Remove um produto de um pedido",
     *     operationId="removeProduct",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id do pedido a ser adicionado novo produto",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         description="product_id",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/Order")
     *     )
     * )
     */
    public function removeProduct(string $id, Request $request)
    {
        try {
            $product_id = $request->get('product_id');
            return response()->json($this->orderService->removeProduct($id, $product_id), Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
