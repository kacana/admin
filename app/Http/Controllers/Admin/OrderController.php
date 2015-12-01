<?php namespace App\Http\Controllers\Admin;

use App\models\AddressCity;
use App\models\AddressReceive;
use App\models\AddressWard;
use App\models\Order;
use App\models\OrderDetail;
use Illuminate\Http\Request;
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
            ->edit_column('total', function($row){
                return formatMoney($row->total);
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

    /*
     * Edit order
     *
     * @param int $id
     * @return Response
     */
    public function edit($env, $domain, Request $request,$id){
        if($request->isMethod('PUT')){
            $address_receive = new AddressReceive();
            $address_receive->updateAddress($request->all());
        }
        $order = Order::find($id);
        $buyer = $order->user;
        $user_address = $order->addressReceive;
        $cities = AddressCity::all()->lists('name', 'id');
        $select_city = ($user_address->city_id!='') ? $user_address->city_id : CITY_ID_DEFAULT;
        $city = AddressCity::find($select_city);
        $wards = $city->ward->lists('name', 'id');
        return view('admin.order.edit', compact('order', 'buyer', 'user_address', 'cities', 'wards'));
    }

    /*
     * Get List Order Detail of order
     *
     * @param int $id
     * @return array
     */
    public function getListOrderDetail($env, $domain, $id){
        $order = Order::find($id);
        $order_details = $order->orderDetail;
        return Datatables::of($order_details)
            ->edit_column('price', function($row){
                return formatMoney($row->price);
            })
            ->edit_column('subtotal', function($row){
                return formatMoney($row->subtotal);
            })
            ->edit_column('created', function($row){
                return showDate($row->created);
            })
            ->add_column('action', function ($row) {
                $str ="<a href='javascript:void(0)' class='delete' data-id='{$row->id}'><i class='fa fa-remove'></i></a>";
                return $str;
            })
            ->make(true);
    }

    /*
     * show list wards
     *
     * @param int $id
     * @return Response
    */
    public function showListWards($env, $domain, $id)
    {
        $ward = new AddressWard;
        $lists = $ward->getItemsByCityId($id)->lists('name', 'id');
        echo Form::select('ward_id', $lists,null, array('class'=>'form-control'));
    }

    /*
     * Delete order detail
     * @param Request $request
     */
    public function deleteOrderDetail($env, $domain, $id){
        $order_detail = new OrderDetail();
        $order_detail->deleteItem($id);
    }

}
