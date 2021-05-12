<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
   public $timestamps = false; //set time to false
    // fillable có thể làm đầy khi insert dữ liệu vào các cột
    protected $fillable = [
    	'name_quanhuyen', 'type', 'matp',
    ];
    protected $primaryKey = 'maqh';
 	protected $table = 'tbl_quanhuyen';
}
