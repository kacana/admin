<?php namespace App\models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DB;

class Order extends Model  {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order';
    public $timestamps = false;

    /**
     * Get the order detail associated with order
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetail()
    {
        return $this->hasMany('App\models\OrderDetail');
    }

    /**
     * Get the user that owns the order
     */
    public function user()
    {
        return $this->belongsTo('App\models\User', 'user_id');
    }

    /**
     * Get the addressReceive that owns the order
     */
    public function addressReceive()
    {
        return $this->belongsTo('App\models\AddressReceive', 'address_id');
    }

    /*
     * Create item
     *
     * @param array $item
     * @return $object
     */
    public function createItem($item){
        $object = new Order();
        foreach($item as $k=>$v){
            $object->$k = $v;
        }
        $object->created = date('Y-m-d H:i:s');
        $object->updated = date('Y-m-d H:i:s');
        $object->save();
        return $object;
    }

    /*
     *
     */

}
