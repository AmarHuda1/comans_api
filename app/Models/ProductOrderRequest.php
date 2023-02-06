<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrderRequest extends Model
{
  use HasFactory;
  protected $table = 'product_order_requests';
  protected $primaryKey = 'product_order_requests_id';
  public $incrementing = false;
  protected $keyType = 'string';
  protected $fillable = [
      'product_order_requests_id','warehouse_id', 'product_code', 'request_date', 'quantity',
  ];
}
