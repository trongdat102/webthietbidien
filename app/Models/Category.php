<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'category_id', 'category_name', 'category_desc', 'category_status', 'create_at', 'updated_at'

    ];
    protected $primaryKey = 'category_id';
    protected $table = 'tbl_category_product';
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
