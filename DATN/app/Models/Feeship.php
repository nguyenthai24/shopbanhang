<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
   public $timestamps = false; //set time to false
    // fillable có thể làm đầy khi insert dữ liệu vào các cột
    protected $fillable = [
    	'fee_tp', 'fee_qh', 'fee_xaid', 'fee_feeship',
    ];
    protected $primaryKey = 'fee_id';
 	protected $table = 'tbl_feeship';


 	// belongsTo thuộc về
 	//feeship này thuộc về tp dựa vào App\Models\City lấy mã id tp để so sánh vs fee_tp để lấy dữ liệu
 	public function city(){
 		return $this->belongsTo('App\Models\City', 'fee_tp');
 	}
 	public function province(){
 		return $this->belongsTo('App\Models\Province', 'fee_qh');
 	}
 	public function wards(){
 		return $this->belongsTo('App\Models\Wards', 'fee_xaid');
 	}
}


