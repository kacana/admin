<?php namespace App\Http\Controllers\Client;

use App\models\Product;
use App\models\Tag;
use Illuminate\Support\Facades\Request;
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

    /*
     * function mame: listProduct
     * @params:
     * @return: view
     */
    public function listProductByCate($env, $domain, $cateId){
        $page = 1;
        $options = ['cateId' => $cateId];
        $product = new Product;
        $data['tag'] = Tag::findOrFail($cateId);
        $data['items'] = $product->getItems(LIMIT_PER_PAGE, $page, $options);
        return view('client.product.listproduct', $data);
    }

    public function loadListProducts(){

        if(Request::ajax()){
            $product = new Product();
            $page = Request::input('page', 1);
            $cateId = Request::input('cateId');
            $options = ['cateId'=>$cateId];
            $data['tag'] = $cateId;
            $data['items'] = $product->getItems(LIMIT_PER_PAGE, $page, $options);
            return view('client.product.ajax-pagination', $data);
        }
    }

    public function filterProduct(){
        if(Request::ajax()){
            $product = new Product();
            $page = Request::input('page', 1);
            $cate_id = Request::input('c');
            $brand = Request::input('b');
            $color = Request::input('cl');
            $options = ['cateId' => $cate_id, 'brand'=>$brand, 'color'=>$color];
            $data['items'] = $product->getItems(LIMIT_PER_PAGE, $page, $options);
            return view('client.product.ajax-pagination', $data);
        }
    }
}