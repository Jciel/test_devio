<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;

class FiscalPrinterService
{
    protected IntlMoneyFormatter $moneyFormatter;
    public function __construct()
    {
        $currencies = new ISOCurrencies();
        $numberFormatter = new \NumberFormatter('pt_BR', \NumberFormatter::CURRENCY);
        $this->moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);
    }

    public function printTax(Order $order)
    {
        $products = $this->listProducts($order);
        $clientName = $order->getAttribute("client-name");
        $total = $this->moneyFormatter->format($order->getAttribute('total'));

        $text = <<<EOD
            CUPOM FISCAL

            Cliente: $clientName
            $products
            total .......... $total
        EOD;

        return $text;
    }

    protected function listProducts(Order $order): string
    {
        return $order->products()->get()->reduce(function ($acc, Product $product) {
            $name = $product->getAttribute('name');
            $price = $this->moneyFormatter->format($product->getAttribute('price'));
            return $acc . "$name .......... $price\n";
        }, "");
    }
}
