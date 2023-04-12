<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

	protected $table = 'products';
	protected $primaryKey = 'product_id';
	public $timestamps = false;
	
	protected $guarded = [];

	public function user ()
	{
		return $this->belongsTo('\App\Models\User', 'product_assigned_to');
	}
}
