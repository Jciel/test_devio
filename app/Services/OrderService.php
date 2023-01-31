<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class OrderService
{
    private Order $orderModel;

    private FiscalPrinterService $fiscalPrinterService;

    public function __construct(Order $orderModel, FiscalPrinterService $fiscalPrinterService)
    {
        $this->orderModel = $orderModel;
        $this->fiscalPrinterService = $fiscalPrinterService;
    }

    public function getAll(): Collection
    {
        return $this->orderModel->all()->load('products');
    }

    public function getOrderDone(): Collection
    {
        return $this->orderModel->where('status', 'DONE')->get();
    }

    public function getOrderToDo(): Collection
    {
        return $this->orderModel->where('status', 'TODO')->get();
    }

    public function finalizeOrder(string $id): Order
    {
        $order = $this->orderModel->find($id)->load('products');
        $order->setAttribute('status', 'DONE');
        $order->save();
        return $order;
    }

    public function addProduct(string $orderId, string $productId): Order
    {
        $order = $this->orderModel->find($orderId)->load('products');
        $order->products()->attach($productId);
        return $this->orderModel->find($orderId)->load('products');
    }

    public function removeProduct(string $orderId, string $productId): Order
    {
        $order = $this->orderModel->find($orderId);
        $order->products()->detach($productId);
        return $this->orderModel->find($orderId)->load('products');
    }
}
