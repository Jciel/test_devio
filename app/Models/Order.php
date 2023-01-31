<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OpenApi\Annotations as OA;

use Money\Money;
use Ramsey\Uuid\Uuid;

/**
 * @OA\Schema(
 *     description="Order model",
 *     type="Illuminate\Database\Eloquent\Model",
 *     title="Order"
 * )
 */
class Order extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = ['id', 'clientName', 'total', 'change', 'status', 'currency'];

    protected $casts = [
        'total' => \App\Casts\Money::class . ':total,currency',
        'change' => \App\Casts\Money::class . ':change,currency'
    ];

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'Uuid';

    /**
     * @OA\Property(
     *     default="",
     *     format="string",
     *     description="Client Name",
     *     type="string"
     * )
     *
     * @var string
     */
    public string $clientName = "";

    /**
     * @OA\Property(
     *     default=0,
     *     format="integer",
     *     description="Total",
     *     type="int"
     * )
     *
     * @var integer
     */
    public int $total = 0;

    /**
     * @OA\Property(
     *     default=0,
     *     format="integer",
     *     description="Change",
     *     type="int"
     * )
     *
     * @var integer
     */
    public int $change = 0;

    /**
     * @OA\Property(
     *     default="TODO",
     *     format="string",
     *     description="Order status.",
     *     enum={"DONE", "TODO"},
     * )
     *
     * @var string
     */
    public string $status = "";

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * @OA\Property(
     *     default="[]",
     *     format="[#/components/schemas/Product]",
     *     type="array",
     *     description="Order Products",
     *     @OA\Items(ref="#/components/schemas/Product")
     * )
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, "order_products");
    }

    protected static function booted(): void
    {
        static::retrieved(function (Order $order) {
            $order->setAttribute('total', Money::BRL($order->products()->sum('price')));
        });

        static::saving(function (Order $order) {
            $order->setAttribute('total', Money::BRL($order->products()->sum('price')));
        });
    }
}
