<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class AddressWard extends Model {

    protected $table = 'address_ward';
    public $timestamps = false;

    /**
     * Get the city that owns the ward.
     */
    public function city()
    {
        return $this->belongsTo('App\models\AddressCity', 'city_id');
    }

    /**
     * Get the address receive associated with address ward
     */
    public function addressReceive()
    {
        return $this->hasMany('App\models\AddressReceive');
    }

    public function scopeShowName($query, $id)
    {
        if(is_numeric($id)){
            return $query->where('id',$id)->pluck('name');
        }else{
            return '';
        }
    }

    /*
     * function name: getItemsByCityId
     * @params: city_id
     * @return list wards
     */
    public function getItemsByCityId($id){
        return $this->where('city_id', $id)->get();
    }
}
