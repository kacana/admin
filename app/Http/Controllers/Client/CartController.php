<?php namespace App\Http\Controllers\Client;

use App\models\Product;
use Datatables;
use Cart;
use Illuminate\Support\Facades\Request;


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
        return view('client.cart.index', array('cart'=>$cart, 'total'=>$total));
    }
}
