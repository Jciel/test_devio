<?php

namespace App\Models;

use App\Casts\Money;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     description="Product model",
 *     type="Illuminate\Database\Eloquent\Model",
 *     title="Product"
 * )
 */
class Product extends Model
{
    use HasUuids, HasFactory;

    protected $casts = ['price' => Money::class . ':price,currency'];

    protected $fillable = ['name', 'image', 'description', 'code', 'price', 'currency'];

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
     *     description="Name",
     *     type="string"
     * )
     *
     * @var string
     */
    public string $name;


    /**
     * @OA\Property(
     *     default="",
     *     format="string",
     *     description="Image",
     *     type="string"
     * )
     *
     * @var string
     */
    public string $image;

    /**
     * @OA\Property(
     *     default="",
     *     format="string",
     *     description="Description",
     *     type="string"
     * )
     *
     * @var string
     */
    public string $description;

    /**
     * @OA\Property(
     *     default=0,
     *     format="integer",
     *     description="Code",
     *     type="int"
     * )
     *
     * @var integer
     */
    public int $code;

    /**
     * @OA\Property(
     *     default=0,
     *     format="integer",
     *     description="Price",
     *     type="int"
     * )
     *
     * @var integer
     */
    public int $price;


    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
