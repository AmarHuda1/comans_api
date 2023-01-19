<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = [
        'product_code',
        'brand',
        'name',
        'category_id',
        'buy_price',
        'price_rec_from_sup',
        'price_rec',
        'profit_margin',
        'description',
        'property',
        'supplier_id',
    ];
}
