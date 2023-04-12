<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

	protected $table = 'genders';
	protected $primaryKey = 'gender_id';
	public $timestamps = false;
	
	protected $guarded = [];
}
