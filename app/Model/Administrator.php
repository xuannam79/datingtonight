<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrator extends Authenticatable
{
    protected $guard = "admins";
    protected $table = "administrator";
    protected $primaryKey = "id_admin";
    public $timestamps = false;

    public function checkLogin($username, $password){
        $checkAdmin = DB::table('administrator')->where('username','=',$username)->where('password','=',$password)->count();
        if($checkAdmin >= 1){
            return true;
        } else {
            return false;
        }
    }

    public function getIdAdmin($username){
        return DB::table('administrator')->where('username','=',$username)->get();
    }

    public function getItems(){
    	return DB::table('administrator')->select('id_admin','username','password','fullname','name_role')->join('admin_role','administrator.id_role','=','admin_role.id_role')->get();
    }

    public function getItem($id){
    	return DB::table('administrator')->select('id_admin','username','password','fullname','name_role','administrator.id_role')->join('admin_role','administrator.id_role','=','admin_role.id_role')->where('id_admin','=',$id)->first();
    }

    public function getNameRoles(){
    	return DB::table('admin_role')->select('id_role','name_role')->get();
    }

    public function addItem($arItem){
    	return $this->insert($arItem);
    }

    public function editItem($id, $arItem){
        return $this->where('id_admin',$id)->update($arItem);
    }

    public function delItem($id){
        return $this->where('id_admin',$id)->delete();
    }
}
