<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use Image;
use App\models\Tag;
use Datatables;
use App\models\Product;


class ProductController extends BaseController {

	/**
	 * Show products.
	 *
	 * @return Response
	 */
	public function index()
	{
        return view('admin.product.index');
	}

    /**
     * get products
     *
     * @return Response
     */
    public function getProduct()
    {
        $products = Product::all();
        return Datatables::of($products)
            ->edit_column('image', function($row) {
                if(!empty($row->image)){
                    return showImage($row->image, PRODUCT_IMAGE . $row->id);
                }
            })
            ->edit_column('price', function($row){
                return formatMoney($row->price);
            })
            ->edit_column('sell_price', function($row){
                return formatMoney($row->sell_price);
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

    /**
     * create product
     *
     * @param Request request
     * @return Response
     */
    public function createProduct(ProductRequest $request)
    {
        $product = new Product;
        if($request->isMethod('post')) {
            $product->createItem($request->all());
            return redirect('product')->with('success', 'Tạo sản phẩm thành công!');
        }
        return view('admin.product.add-product');

    }

    /**
     * edit product
     *
     * @param CreateProductRequest $requestprodu
     * @return Response
     */
    public function editProduct($env, $domain, $id, ProductRequest $request)
    {
        if($request->isMethod('put')){
            $product = new Product;
            $product->updateItem($id, $request->all());
            return redirect('product')->with('success', 'Cập nhật sản phẩm thành công!');
        }
        $product = Product::find($id);
        return view('admin.product.edit-product', $product);
    }

    /**
     * remove Product
     * @param $id
     */
    public function removeProduct($env, $domain, $id)
    {
        Product::find($id)->delete();
    }

    /**
     * get tag
     */
    public function listTags(ProductRequest $request)
    {
        $key = $request->get('key');
        $tags = Tag::search($key);
        return view('admin.product.list-tags', array('tags'=>$tags));
    }

    /**
     * set status
     * @params $id, $status
     */
    public function setStatus($env, $domain, $id, $status)
    {
        $str = '';
        $product = new Product();
        if($product->updateItem($id, (array('status'=>$status)))){
            if($status == 0){
                $str = "Đã chuyển sang trạng thái inactive thành công!";
            }else{
                $str = "Đã chuyển sang trạng thái active thành công!";
            }
        }
        return $str;
    }
}
