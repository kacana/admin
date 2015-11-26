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
    public function listProductByCate($env, $domain, $tagId){
        $page = 1;

        $tag =Request::input('tagId');
        $tag = $tag!="" ? $tag:$tagId;
        $brand = Request::input('brand');
        $color = Request::input('color');
        $sort = Request::input('sort');
        $options = ['tagId' => $tag, 'brand'=>$brand, 'color'=>$color, 'sort'=>$sort];
        $product = new Product;
        $data['tag'] = Tag::findOrFail($tagId);
        $data['items'] = $product->getItems(LIMIT_PER_PAGE, $page, $options);
        return view('client.product.listproduct', $data);
    }

    public function loadListProducts(){
        if(Request::ajax()){
            $product = new Product();
            $page = Request::input('page', 1);
            $tagId = Request::input('tagId');
            $options = ['tagId'=>$tagId];
            $data['tag'] = $tagId;
            $data['items'] = $product->getItems(LIMIT_PER_PAGE, $page, $options);
            return view('client.product.ajax-pagination', $data);
        }
    }

    public function filterProduct(){
        if(Request::ajax()){
            $product = new Product();
            $tag = Request::input('tagId');
            $page = Request::input('page', 1);
            $brand = Request::input('brand');
            $color = Request::input('color');
            $sort = Request::input('sort');
            $options = ['tagId' => $tag, 'brand'=>$brand, 'color'=>$color, 'sort'=>$sort];
            $data['page'] = $page;
            $data['items'] = $product->getItems(LIMIT_PER_PAGE, $page, $options);
            return view('client.product.ajax-pagination', $data);
        }
    }
}