<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
   public $timestamps = false;
    protected $fillable = [
          'provider_user_id',  'provider',  'user'
    ];
 
    protected $primaryKey = 'user_id';
 	protected $table = 'tbl_social';
 	
 	public function login(){
 		// lấy admin_id của tbl_login rồi insert vào user khi thêm mới 1 Social
 		return $this->belongsTo('App\Models\Login', 'user');
 	}
}
