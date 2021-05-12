<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public $timestamps = false; //set time to false
    
    protected $fillable = [
    	'shipping_name', 'shipping_email', 'shipping_phone','shipping_note','shipping_address', 'shipping_method'
    ];
    protected $primaryKey = 'shipping_id';
 	protected $table = 'tbl_shipping';
}
