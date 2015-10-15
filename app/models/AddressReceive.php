<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class AddressReceive extends Model {

    protected $table = 'address_receive';
    public $timestamps = false;

    /**
     * Get the user associated with product
     */
    public function userAddress()
    {
        return $this->hasMany('App\models\UserAddress');
    }

    /**
     * Get the user associated with product
     */
    public function city()
    {
        return $this->belongsTo('App\models\AddressCity', 'city_id');
    }

    /**
     * Get the user associated with product
     */
    public function ward()
    {
        return $this->belongsTo('App\models\AddressWard', 'ward_id');
    }

    /**
     * update information
     *
     * @param id
     * @param options = array()
     * @return true or false
     */
    public function updateItem($id, $options){

        if(isset($options['_token'])){
            unset($options['_token']);
        }
        $this->where('id', $id)->update($options);
        return AddressReceive::find($id);
    }

}
