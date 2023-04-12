<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    protected $primaryKey = 'company_id';
    public $timestamps = false;

    protected $guarded = [];

    public function country ()
    {
        return $this->belongsTo('\App\Models\Country', 'company_country');
    }
}
