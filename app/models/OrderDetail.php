<?php namespace App\models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model  {
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_detail';
    protected $dates = ['delete_at'];
    public $timestamps = false;

    /**
     * Get the order detail associated with order
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order()
    {
        return $this->belongsTo('App\models\Order', 'order_id');
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
                if(isset($item->options['color'])){
                    $orderObj->color = $item->options['color'][0];
                }

                $orderObj->save();
            }
        }
        return true;
    }

    public function product()
    {
        return $this->belongsTo('App\models\Product');
    }

    /*
     * Get Items By Order Id
     *
     * @param int $id
     * @return array
     */
    public function getItemsByOrderId($id){
        return $this->where('order_id', $id)->get();
    }

    /*
     * Delete item
     * @param int $id
     */
    public function deleteItem($id){
        $order_detail = OrderDetail::find($id);
        $order = $order_detail->order;
        $subtotal = $order_detail->subtotal;
        if($order_detail->delete()){
            $order->total = $order->total - $subtotal;
            $order->save();
            return true;
        }
        return false;
    }
}
