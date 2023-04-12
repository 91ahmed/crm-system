<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifi extends Model
{
    use HasFactory;

	protected $table = 'notifi';
	protected $primaryKey = 'notifi_id';
	public $timestamps = false;
	
	protected $guarded = [];

    public function user ()
    {
        return $this->belongsTo('\App\Models\User', 'notifi_user');
    }
}
