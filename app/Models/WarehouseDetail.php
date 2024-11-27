<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'warehouse_name','warehouse_id', 'product_id','warehouse_details_quantity','warehouse_details_price','warehouse_details_date','warehouse_details_status','create_at'
    ];
    protected $primaryKey = 'warehouse_details_id';
    protected $table = 'tbl_warehouse_details';
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }
}
