<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    use HasFactory;

	protected $table = 'user_permission';
	protected $primaryKey = 'user_permission_id';
	public $timestamps = false;

	protected $guarded = [];
}
