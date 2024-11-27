<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'customer_id', 'shipping_id', 'order_status', 'order_code', 'create_at', 'order_date', 'order_destroy'

    ];
    protected $primaryKey = 'order_id';
    protected $table = 'tbl_order';
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'order_code', 'order_code');
    }

    public function calculateTotal()
    {
        return $this->orderDetails->sum(function ($detail) {
            return $detail->product_price * $detail->product_sales_quantity;
        });
    }
}