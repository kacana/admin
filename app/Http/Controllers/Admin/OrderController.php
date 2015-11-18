<?php namespace App\Http\Controllers\Admin;

use App\models\Order;
use Image;
use Datatables;

class OrderController extends BaseController {

    public function index($env, $domain){
        return view('admin.order.index');
    }

    public function getList(){

        $orders = Order::all();
        foreach($orders as $order){
            $order->orderDetail;
            $order->user;
        }

        return Datatables::of($orders)
            ->add_column('name', function($row) {
                if(!empty($row->user)){
                    return $row->user->name;
                }
            })
            ->add_column('phone', function($row) {
                if(!empty($row->user)){
                    return $row->user->phone;
                }
            })
            ->edit_column('status', function($row){
                return showSelectStatusOrder($row->id, $row->status);
            })
            ->edit_column('created', function($row){
                return showDate($row->created);
            })
            ->add_column('action', function ($row) {
                return showActionButton("/order/edit/".$row->id, false, false, false);
            })
            ->make(true);
    }

    public function edit($env, $domain, $id){
        return view('admin.order.edit');
    }
}
