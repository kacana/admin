<?php namespace App\Http\Controllers\Client;

use App\models\Product;
use Datatables;



class ProductController extends BaseController {

    /*
     * function mame: productDetail
     * @params: id
     * @return: view
     */
    public function productDetail($env, $domain, $id)
    {
        $product = Product::find($id);
        $data['item'] = $product;
        return view('client.product.detail', $data);
    }
}
