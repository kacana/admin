<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class AddressCity extends Model {

    protected $table = 'address_city';
    public $timestamps = false;

    /**
     * Get the user associated with product
     */
    public function ward()
    {
        return $this->hasMany('App\models\AddressWard');
    }

    /**
     * Get the address receive associated with address city
     */
    public function addressReceive()
    {
        return $this->hasMany('App\models\AddressReceive');
    }

    public function scopeShowName($query, $id)
    {
        if($id!=0){
            return $query->where('id',$id)->pluck('name');
        }else{
            return '';
        }
    }


}
