<?php namespace App\models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DB;

class OrderDetail extends Model  {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_detail';
    public $timestamps = false;

    /**
     * Get the order detail associated with order
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order()
    {
        return $this->belongsTo('App\models\Order');
    }

    public function createItems($orderId, $carts){
        if(count($carts)>0){
            foreach($carts as $item){
                $orderObj= new OrderDetail();

                $orderObj->order_id = $orderId;
                $orderObj->name = $item->name;
                $orderObj->price = $item->price;
                $orderObj->quantity = $item->qty;
                $orderObj->subtotal = $item->subtotal;
                $orderObj->product_id = $item->id;
                $orderObj->created = date('Y-m-d H:i:s');
                $orderObj->updated = date('Y-m-d H:i:s');
                $orderObj->color = '';
                $orderObj->size = '';

                $orderObj->save();
            }
        }
        return true;
    }

    /*
     * function name: getItemsByOrderId
     */
    public function getItemsByOrderId($orderId){
        return $this->where('order_id', $orderId)->get();
    }
}
