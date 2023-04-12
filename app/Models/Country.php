<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

	protected $table = 'countries';
	protected $primaryKey = 'country_id';
	public $timestamps = false;
	
	protected $guarded = [];
}
