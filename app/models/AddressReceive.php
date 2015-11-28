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

    /**
     * - function name : createItem
     */
    public function createItem($item)
    {
        $addReceive = new AddressReceive();

        $addReceive->name = $item['name'];
        $addReceive->email = isset($item['email'])?$item['email']:'';
        $addReceive->phone = $item['phone'];
        $addReceive->street = $item['street'];
        $addReceive->city_id = $item['city_id'];
        $addReceive->ward_id = $item['ward_id'];
        $addReceive->save();

        return $addReceive;
    }

    /*
     * Update
     * @param array $inputs
     * @return boolean
     */
    public function updateAddress($inputs){
        $id = isset($inputs['id']) ? $inputs['id']:'';
        if($id!=''){
            $add_receive = AddressReceive::find($id);
            $add_receive->street = $inputs['street'];
            $add_receive->city_id = $inputs['city_id'];
            $add_receive->ward_id = $inputs['ward_id'];
            if($add_receive->save()){
                return true;
            }
        }
        return false;
    }


}
