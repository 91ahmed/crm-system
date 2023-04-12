<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

	protected $table = 'status';
	protected $primaryKey = 'status_id';
	public $timestamps = false;

	protected $guarded = [];
}
