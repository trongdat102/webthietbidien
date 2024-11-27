<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'category_id', 'product_name','product_quantity','product_sold', 'brand_id', 'provider_id', 'create_at', 'product_desc', 'product_content', 'product_price', 'product_image', 'product_status','created_at','updated_at'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function provider()
    {
        return $this->belongsTo(ProvideProduct::class, 'provider_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function warehouseDetails()
    {
        return $this->hasMany(WarehouseDetail::class, 'product_id');
    }
}
