<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'warehouse_name', 'warehouse_address','create_at'
    ];
    protected $primaryKey = 'warehouse_id';
    protected $table = 'tbl_warehouse';
    public function WarehouseDetail()
    {
        return $this->hasMany(WarehouseDetail::class, 'warehouse_id');
    }
}
