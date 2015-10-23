<?php namespace App\models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Image;
use DB;

class Product extends Model  {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product';
    public $timestamps = false;

    /**
     * Get the tags associated with product
     */
    public function tag()
    {
        return $this->belongsToMany('App\models\Tag');
    }

    /**
     *
     * @param $item
     */
    public function createItem($item)
    {
        $product = new Product;

        $product->name = $item['name'];
        $product->description = $item['description'];
        $product->price = $item['price'];
        $product->sell_price = $item['sell_price'];
        $product->created = date('Y-m-d H:i:s');
        $product->updated = date('Y-m-d H:i:s');
        $product->save();

        //update image after save product
        if (isset($item['image']) && ($item['image']!=='undefined')) {
            $this->updateImage($item['image'], $product->id);
        }

        //update description with image
        if(!empty($item['description'])){
            $this->updateDescWithImg($item['description'], $product->id);
        }
        //add tags
        if(!empty($item['tags'])){
            foreach($item['tags'] as $k=>$v){
                $product->tag()->attach($v);
            }
        }
    }

    function updateImage($image, $id)
    {
        $original_name = explode(".", $image->getClientOriginalName());
        $original_name = $original_name[0];

        $new_name = PREFIX_IMG_PRODUCT . str_slug($original_name, "-") . '_main.' . $image->getClientOriginalExtension();

        $path = public_path(PRODUCT_IMAGE . $id);

        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }else{
            chmod($path, 0777);
        }
        Image::make($image->getRealPath())->save($path . '/' . $new_name);

        return $this->where('id', $id)->update(array('image' => $new_name));
    }

    /*
     * using when input description with image
     */
    function updateDescWithImg($descriptions, $id, $is_edit=false)
    {
        preg_match_all('/(http|https):\/\/[^ ]+(\.gif|\.jpg|\.jpeg|\.png)/',$descriptions, $out);
        if($out[0]){
            $count = 1;
            //count item already renamed
            if($is_edit){
                foreach($out[0] as $img){
                    if(strrpos($img, 'tmp')=== FALSE) {
                        $count++;
                    }
                }
            }
            foreach($out[0] as $img){
                if(strrpos($img, 'tmp')!== FALSE) {
                    $img_file = str_replace(LINK_IMAGE . 'images/product/tmp/', '', $img);
                    $path = public_path(PRODUCT_IMAGE . $id);

                    $img_arr = explode('.', strtolower($img_file));

                    $img_name = $img_arr[0];
                    $type = end($img_arr);
                    $new_name = PREFIX_IMG_PRODUCT . str_slug($img_name, "-") . "_" . $count . '.' . $type;

                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    } else {
                        chmod($path, 0777);
                    }
                    Image::make($img)->save($path . '/' . $new_name);
                    $descriptions = str_replace('tmp/' . $img_file, $id . '/' . $new_name, $descriptions);
                    unlink(public_path(PRODUCT_IMAGE.'tmp/') . $img_file);
                }
                $count++;
            }
        }
        $this->where('id', $id)->update(array('description' => $descriptions));
    }

    /**
     * update information
     *
     * @param id
     * @param options = array()
     * @return true or false
     */
    public function updateItem($id, $options){
        $product = Product::find($id);
        $options['updated'] = date('Y-m-d H:i:s');
        if(isset($options['_token'])){
            unset($options['_token']);
        }

        if (isset($options['image']) && ($options['image']!=='undefined')) {
            $this->updateImage($options['image'], $id);
            unset($options['image']);
        }else{
            unset($options['image']);
        }

        if(!empty($options['description'])){
            $this->updateDescWithImg($options['description'], $id, true);
            unset($options['description']);
        }
        //add tags
        $product->tag()->detach();
        if(!empty($options['tags'])) {
            foreach ($options['tags'] as $k => $v) {
                $product->tag()->attach($v);
            }
            unset($options['tags']);
        }

        $this->where('id', $id)->update($options);
    }

    public function getItemsByTag($tag, $limit){
        $query = DB::table('product')
            ->select('product.id', 'product.name', 'product.price', 'product.image')
            ->join('product_tag', 'product.id', '=', 'product_tag.product_id')
            ->where('product_tag.tag_id', 1)
            ->take(6)
            ->get();
        return $query;
    }
}
