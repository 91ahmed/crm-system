<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityTarget extends Model
{
    use HasFactory;

    protected $table = 'activities_targets';
    protected $primaryKey = 'activity_target_id';
    public $timestamps = false;

    protected $guarded = [];
}
