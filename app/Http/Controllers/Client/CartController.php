<?php namespace App\Http\Controllers\Client;

use App\models\AddressReceive;
use App\models\Order;
use App\models\OrderDetail;
use App\models\Product;
use App\models\AddressCity;
use App\models\AddressWard;
use App\models\User;
use App\models\UserAddress;
use Datatables;
use Cart;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\CartRequest;


class CartController extends BaseController {

    /*
     * function mame: productDetail
     * @params: id
     * @return: view
     */
    public function addProductToCart()
    {
        if (Request::isMethod('post')) {
            $product_id = Request::get('product_id');
            $product_name = Request::get('product_name');
            $product_price = Request::get('product_price');
            Cart::add(array('id' => $product_id, 'name' => $product_name, 'qty' => 1, 'price' => $product_price));
        }

        return redirect('cart/showCart');
    }

    /*
     * function mame increaseQty
     * increase quantity of product
     */
    public function increaseQty($env, $domain, $pid)
    {
        $rowId = Cart::search(array('id'=>$pid));
        $item = Cart::get($rowId[0]);
        Cart::update($rowId[0], $item->qty+1);
        return redirect('cart/showCart');
    }

    /*
     * function mame decreaseQty
     * decrease quantity of product
     */
    public function decreaseQty($env, $domain, $pid)
    {
        $rowId = Cart::search(array('id'=>$pid));
        $item = Cart::get($rowId[0]);
        Cart::update($rowId[0], $item->qty - 1);
        return redirect('cart/showCart');
    }

    /*
     * function mame decreaseQty
     * decrease quantity of product
     */
    public function updateCart()
    {

    }

    /*
     * function name removeCart
     */
    public function removeCart($env, $domain, $pid)
    {
        $rowId = Cart::search(array('id'=>$pid));
        Cart::remove($rowId[0]);
        return redirect('cart/showCart');
    }

    public function showCart()
    {
        $cart = Cart::content();
        $total = Cart::total();
        $cities = AddressCity::lists('name','id');
        $ward = new AddressWard();
        $wards = $ward->getItemsByCityId(CITY_ID_DEFAULT)->lists('name', 'id');

        return view('client.cart.index', array('cart'=>$cart,'total'=>$total, 'cities'=>$cities, 'wards'=>$wards));
    }

    /*
     * function name processCart
     */
    public function processCart(CartRequest $request)
    {
        $re = array();
        if(Request::isMethod('post') && $request->all()){
            //save user
            $user = new User();
            $item = array(
                'name'  => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'role'  => BUYER
            );
            $createdUser = $user->createItem($item);

            //save address receive
            $userReceive = new AddressReceive();
            $item2 = array(
                'name'      => $request->get('name_2'),
                'phone'     => $request->get('phone_2'),
                'street'    => $request->get('street'),
                'city_id'   => $request->get('city_id'),
                'ward_id'   => $request->get('ward_id')
            );
            $address = $userReceive->createItem($item2);

            if($createdUser && $address){
                //create user address
                $userAddress = new UserAddress();
                $option = array('user_id'=>$createdUser->id, 'address_id'=>$address->id);
                $userAddress->createItem($option);

                //create order and order detail
                $order = new Order();
                $orderAtt = array(
                    'user_id'       => $createdUser->id,
                    'address_id'    => $address->id,
                    'total'         => Cart::total(),
                    'ship'          => 0,
                    'address'       => $address->street . ", " . AddressWard::showName($address->ward_id) . ", " . AddressCity::showName($address->city_id),
                );
                $createdOrder = $order->createItem($orderAtt);

                $orderDetail = new OrderDetail();
                if($orderDetail->createItems($createdOrder->id, Cart::content())){
                    Cart::destroy();
                    $re = array('status'=>'ok', 'id'=>$createdOrder->id);
                };
            }
            echo json_encode($re);
        }
    }

    /*
     *
     */
    public function orderDetail($env, $domain, $orderId){
        $orderDetail = new OrderDetail();
        $data['items'] = $orderDetail->getItemsByOrderId($orderId);
        $data['order'] = Order::find($orderId);
        return view('client.cart.order', $data);
    }

}
