<?php namespace App\Http\Controllers\Client;

use App\models\AddressReceive;
use App\models\Color;
use App\models\Order;
use App\models\OrderDetail;
use App\models\Product;
use App\models\AddressCity;
use App\models\AddressWard;
use App\models\ProductGallery;
use App\models\User;
use App\models\UserAddress;
use Datatables;
use Cart;
use Form;
use Illuminate\Support\Facades\Mail;
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
        $result = array();
        if (Request::isMethod('post')) {
            $pId = Request::get('product_id');
            $pName = Request::get('product_name');
            $pPrice = Request::get('product_price');
            $options = Request::get('qty');
            $product = Product::find($pId);

            if($options!=''){
                $options = explode(',', $options);
                foreach($options as $option){
                    $cId = explode('q', $option)[0];
                    $qty = explode('q', $option)[1];
                    $productGallery = new ProductGallery();
                    $image = showProductImg($productGallery->getImageFromProductAndColor($pId, $cId), $pId);

                    Cart::add(array(
                        'id' => $pId . $cId,
                        'name' => $pName,
                        'qty' => $qty,
                        'price' => $pPrice,
                        'options' => array('color' => Color::showName($cId), 'image'=>$image, 'urlDetail'=>urlProductDetail($product)),
                        ));
                }
                $result = ['status'=>'ok'];
            }else{
                $qty = Request::get('product_qty');
                if($qty>0){
                    Cart::add(
                        array(
                            'id' => $pId,
                            'name' => $pName,
                            'qty' => $qty,
                            'price' => $pPrice,
                            'options'=>array(
                                'image'=>showProductImg($product->image, $pId),
                                'urlDetail'=>urlProductDetail($product)
                            )
                        )
                    );
                    $result = ['status'=>'ok'];
                }else{
                    $result = ['status'=>'error', 'message'=>'Vui lòng chọn số lượng sản phẩm'];
                }
            }
        }
        echo json_encode($result);
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
        if(Request::isMethod('post')){
            $options = Request::get('options');
            if(count($options)>0){
                $options = explode(",", $options);
                foreach($options as $item){
                    $cId = explode('q', $item)[0];
                    $qty = explode('q', $item)[1];
                    $rowId = Cart::search(array('id'=>$cId));
                    Cart::update($rowId[0], $qty);
                }
            }
        }
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
            $uid = 0;
            $username = "";
            $email = "";
            $existUser = $user->getUserByEmail($request->get('email'));

            if(!empty($existUser)){
                $uid = $existUser->id;
                $username = $existUser->name;
                $email = $existUser->email;
            }else{
                $item = array(
                    'name'  => $request->get('name'),
                    'email' => $request->get('email'),
                    'phone' => $request->get('phone'),
                    'role'  => BUYER
                );
                $createdUser = $user->createItem($item);
                $uid = $createdUser->id;
                $username = $createdUser->name;
                $email = $createdUser->email;
            }

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

            if($uid!=0 && $address){
                //create user address
                $userAddress = new UserAddress();
                $option = array('user_id'=>$uid, 'address_id'=>$address->id);
                $userAddress->createItem($option);

                //create order and order detail
                $order = new Order();
                $orderAtt = array(
                    'user_id'       => $uid,
                    'address_id'    => $address->id,
                    'total'         => Cart::total(),
                    'ship'          => 0,
                    'address'       => $address->street . ", " . AddressWard::showName($address->ward_id) . ", " . AddressCity::showName($address->city_id),
                );
                $createdOrder = $order->createItem($orderAtt);

                $orderDetail = new OrderDetail();
                if($orderDetail->createItems($createdOrder->id, Cart::content())){
                    //send email
                    $data = array(
                        'username'      => $username,
                        'linkWebsite'   => SITE_LINK,
                        'receiveName'   => $address->name,
                        'receiveAddress'=> $createdOrder->address,
                        'receivePhone'  => $address->phone,
                        'carts'         => Cart::content(),
                        'total'         => Cart::total(),
                    );
                    Cart::destroy();
                    if($this->sendEmailOrder($email, $username, $data)){
                        $re = array('status'=>'ok', 'id'=>$createdOrder->id);
                    }else{
                        $re = array('status'=>'error', 'message' => 'Bị lỗi trong quá trình gửi mail');
                    }
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

    /*
    * - function mame: showListWards
    */
    public function showListWards()
    {
        $id = Request::get('id');
        $ward = new AddressWard;
        $lists = $ward->getItemsByCityId($id)->lists('name', 'id');
        echo Form::select('ward_id', $lists,null, array('class'=>'form-control', 'id'=>'ward')) . '<span id="error-ward" class="text-red error"></span>';
    }

    /*
     *
     */
    public function sendEmailOrder($email, $username, $data)
    {
        $subject = "Thông tin đặt hàng";
        Mail::send('client.emails.send-email-order', $data, function($message) use($email, $username, $subject){
            $message->to($email, $username)->bcc(ADMIN_EMAIL)->subject($subject);
        });
        return true;
    }

}
