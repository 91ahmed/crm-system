<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityStatus extends Model
{
    use HasFactory;

    protected $table = 'activities_status';
    protected $primaryKey = 'activity_status_id';
    public $timestamps = false;

    protected $guarded = [];
}
