<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

	protected $table = 'campaigns';
	protected $primaryKey = 'campaign_id';
	public $timestamps = false;
	
	protected $guarded = [];

	public function user ()
	{
		return $this->belongsTo('\App\Models\User', 'campaign_assigned_to');
	}
}
