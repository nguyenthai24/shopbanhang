<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps = false; //set time to false
    // fillable có thể làm đầy khi insert dữ liệu vào các cột
    protected $fillable = [
    	'brand_name', 'brand_slug', 'brand_desc','brand_status','meta_keywords'
    ];
    protected $primaryKey = 'brand_id';
 	protected $table = 'tbl_brand';
}
