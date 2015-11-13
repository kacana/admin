<?php namespace App\Http\Controllers\Admin;

use App\models\Order;
use Image;
use Datatables;

class OrderController extends BaseController {

    public function index($env, $domain){
        $orders = Order::all();
        foreach($orders as $order){
            $order->orderDetail;
            $order->user;
        }

        return Datatables::of($order)
            ->edit_column('image', function($row) {
                if(!empty($row->image)){
                    return showImage($row->image, PRODUCT_IMAGE . $row->id);
                }
            })
            ->edit_column('status', function($row){
                return showSelectStatus($row->id, $row->status, 'Kacana.product.setStatus('.$row->id.', 1)', 'Kacana.product.setStatus('.$row->id.', 0)');
            })
            ->edit_column('created', function($row){
                return showDate($row->created);
            })
            ->edit_column('updated', function($row){
                return showDate($row->updated);
            })
            ->add_column('action', function ($row) {
                return showActionButton("/product/editProduct/".$row->id, 'Kacana.product.removeProduct('.$row->id.')', false, false);
            })
            ->make(true);
    }

    public function getLists(RequestInfoRequest $request){
        $orders = Order::all();
    }
}
