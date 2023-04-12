<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    public $timestamps = false;

    protected $guarded = [];

    public function lead ()
    {
        return $this->belongsTo('\App\Models\Lead', 'order_lead');
    }

    public function product ()
    {
        return $this->belongsTo('\App\Models\Product', 'order_product');
    }

    public function orderStatus ()
    {
        return $this->belongsTo('\App\Models\OrderStatus', 'order_status');
    }
}
