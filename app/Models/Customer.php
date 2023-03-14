<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = "customers";
    protected $primaryKey = "customer_id";

    // set
    public function setNameAttribute($value){
        $this->attributes['name'] = ucwords($value);
    }

    // get
    public function getDobAttribute($value){
        return get_formatted_date($value, 'd-M-Y');
    }
}
