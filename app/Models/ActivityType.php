<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    use HasFactory;

    protected $table = 'activities_types';
    protected $primaryKey = 'activity_type_id';
    public $timestamps = false;

    protected $guarded = [];
}
