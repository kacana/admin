<?php namespace App\Http\Controllers\Client;

use App\models\Product;
use App\models\Tag;
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
            $data['items'] = $product->getItems(LIMIT_PER_PAGE, $page, $options);
            return View::make('client.product.ajax-pagination', $data);
        }
    }
}
