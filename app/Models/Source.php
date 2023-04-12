<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

	protected $table = 'sources';
	protected $primaryKey = 'source_id';
	public $timestamps = false;
	
	protected $guarded = [];
}
