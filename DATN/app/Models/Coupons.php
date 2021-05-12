<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    public $timestamps = false; //set time to false
    // fillable có thể làm đầy khi insert dữ liệu vào các cột
    protected $fillable = [
    	'coupons_name', 'coupons_code', 'coupons_time','coupons_condition',
    ];
    protected $primaryKey = 'counpons_id';
 	protected $table = 'tbl_coupons';
}
