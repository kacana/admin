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
        return $this->belongsToMany('App\models\Tag', 'product_tag', 'product_id', 'tag_id');
    }

    /**
     * Get the galleries associated with product
     */
    public function galleries()
    {
        return $this->hasMany('App\models\ProductGallery');
    }

    /**
     * Get the galleries associated with product
     */
    public function color()
    {
        return $this -> belongsToMany('App\models\Color', 'product_color', 'product_id', 'color_id')->withPivot('gallery_id');
    }

    /**
     * Create Item
     * @param array $item
     * @return void
     */
    public function createItem($item)
    {
        $product = new Product;
        $product->name = $item['name'];
        $product->description = $item['description'];
        $product->property = $item['property'];
        $product->property_description = $item['property_description'];
        $product->meta = $item['meta'];
        $product->price = $item['price'];
        $product->sell_price = $item['sell_price'];
        $product->created = date('Y-m-d H:i:s');
        $product->updated = date('Y-m-d H:i:s');
        $product->save();

        //update image after save product
        if($product->save()){
            if (isset($item['image']) && ($item['image']!=='undefined')) {
                $this->updateImage($item['image'], $product->id);
            }

            //update description with image
            if(!empty($item['description'])){
                $this->updateDescWithImg($item['description'], $product->id);
            }
            //add tags
            if(!empty($item['tags'])){
                $product->tag()->sync($item['tags']);
            }
        }
    }

    /*
     * Update Image
     *
     * @param string $image
     * @param int $id
     * @return void
     */
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
     * Update Description with image
     *
     * @param string $description
     * @param int $id
     * @param boolean $is_edit
     * @return void
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
     * @param array $s
     * @return boolean
     */
    public function updateItem($id, $inputs){
        $product = Product::find($id);

        $item['updated'] = date('Y-m-d H:i:s');
        $item['name'] = $inputs['name'];
        $item['property_description'] = $inputs['property_description'];
        $item['property'] = $inputs['property'];
        $item['meta'] = $inputs['meta'];
        $item['price'] = $inputs['price'];
        $item['sell_price'] = $inputs['sell_price'];

        if (isset($inputs['image']) && ($inputs['image']!=='undefined')) {
            $this->updateImage($inputs['image'], $id);
        }

        if(!empty($inputs['description'])){
            $this->updateDescWithImg($inputs['description'], $id, true);
        }
        //add tags
        $product->tag()->detach();
        if(!empty($inputs['tags'])) {
            $product->tag()->sync($inputs['tags']);
        }
        $this->where('id', $id)->update($item);
    }

    public function getItemsByTag($tag, $limit){
        $tag_model = new Tag();
        $listChildId = $tag_model->getIdChildsById($tag->id);
        $listChildId[] = $tag->id;

        $query = DB::table('product')
            ->select('product.id', 'product.name', 'product.price', 'product.image')
            ->join('product_tag', 'product.id', '=', 'product_tag.product_id')
            ->whereIn('product_tag.tag_id', $listChildId)
            ->orderBy('created')
            ->take($limit)
            ->get();
        return $query;
    }

    /*
     * Get Items
     *
     * @param int $limit
     * @param int $page
     * @param array $options
     * @return array
     */
    public function getItems($limit, $page, $options){
        $query = DB::table('product')
            ->select('product.id', 'product.name', 'product.price', 'product.image');
        if(is_array($options)){
            if(isset($options['tagId'])){
                $tag = new Tag();
                $listChildId = $tag->getIdChildsById($options['tagId']);
                $listChildId[] = $options['tagId'];
                $query->join('product_tag', 'product.id', '=', 'product_tag.product_id');
                $query->whereIn('product_tag.tag_id', $listChildId);
            }
            if(isset($options['color']) && $options['color']!=0){
                $query->join('product_color', 'product.id', '=', 'product_color.product_id');
                $query->where('product_color.color_id',$options['color']);
            }
            if(isset($options['brand']) && $options['brand']!=0){
                $query->join('product_brand', 'product.id', '=', 'product_brand.product_id');
                $query->where('product_brand.brand_id', $options['brand']);
            }
            if(isset($options['sort'])  && $options['sort']!=''){
                switch($options['sort']){
                    case 'newest':
                        $query->orderBy('updated');
                        break;
                    case 'lh':
                        $query->orderBy('price', 'asc');
                        break;
                    case 'hl':
                        $query->orderBy('price', 'desc');
                        break;
                    default:
                        $query->orderBy('updated');
                }
            }else{
                $query->orderBy('updated');
            }
        }else{
            $query->orderBy('updated');
        }

        if($page > 0){
            return $query->paginate($limit);
        }else{
            return $query->take($limit)->get();
        }
    }

    /*
     * Get Products By Tag
     *
     * @param int $id
     * @return array
     */
    public function getProductsByTag($id){
        $tag = new Tag();
        $listChildId = $tag->getIdChildsById($id);
        $listChildId[] = $id;
        $query = Product::join('product_tag', 'product.id', '=', 'product_tag.product_id')
            ->whereIn('product_tag.tag_id', $listChildId)
            ->orderBy('created')
            ->get();
        return $query;
    }

}
