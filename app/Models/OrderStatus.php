<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $table = 'orders_status';
	protected $primaryKey = 'order_status_id';
	public $timestamps = false;
	
	protected $guarded = [];
}
