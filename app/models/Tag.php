<?php namespace App\models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Image;
use DB;

class Tag extends Model  {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tag';
    public $timestamps = false;

    /**
     * Get the products associated with tags
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function product()
    {
        return $this->belongsToMany('App\models\Product');
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where('name', 'LIKE', '%'.$keyword.'%')->get();
    }


    public function getTagByParentId($parent_id)
    {
        return $this->where('parent_id', $parent_id)->get();
    }
    /*
     * create item
     */
    public function createItem($item)
    {
        $tag = new Tag;
        $tag->name = $item['name'];
        $tag->parent_id = $item['parent_id'];
        $tag->created = date('Y-m-d H:i:s');
        $tag->updated = date('Y-m-d H:i:s');
        $tag->save();
        return $tag;
    }

    /**
     * update information
     *
     * @param int id
     * @param array $inputs
     * @return object
     */
    public function updateItem($id, $inputs){
        $item['updated'] = date('Y-m-d H:i:s');
        $item['name'] = $inputs['name'];
        $item['description'] = $inputs['description'];

        if (isset($inputs['image'])) {
            $this->updateImage($inputs['image'], $id);
        }
        $this->where('id', $id)->update($item);
        $tag = Tag::find($id);
        return $tag;
    }

    public function countChild()
    {
        return $this->where('parent_id', $this->id)->count();
    }

    public function deleteChild($id){
        $tags = $this->where('parent_id', $id)->get();
        if(count($tags)>0){
            foreach($tags as $tag){
                $this->deleteChildRe($tag->id);
            }
            Tag::find($tag->id)->delete();
        }
    }

    public function deleteChildRe($id){
        $tags = $this->where('parent_id', $id)->get();
        if(count($tags)>0){
            foreach($tags as $tag){
                Tag::find($tag->id)->delete();
            }
        }
    }

    /*
     * - get tag id by id product
     */
    public function getIdTagByPid($pid){
        return DB::table('product_tag')->where('product_id', $pid)->lists('tag_id');
    }
    /*
     * Get all tags that set main or sub show on menu
     * @return: list tags
     */
    public function getMainTags(){
        return $this->where('type', 1)->get();
    }

    public function getChilds()
    {
        return $this->where('parent_id', $this->id )->get();
    }

    public static function getTags(){
        $main_tags = DB::table('tag')->where('type', 1)->get();
        $data = array();
        if(count($main_tags)>0){
            foreach($main_tags as $tag){
                $childs = DB::table('tag')->where(array('type'=> 2, 'parent_id'=>$tag->id))->get();
                $item['id'] = $tag->id;
                $item['tag_url'] = urlCategory($tag);
                $item['type'] = $tag->type;
                $item['name'] = $tag->name;
                $item['childs'] = $childs;
                $data[] = $item;
            }
        }
        return $data;
    }

    public function getIdChildsById($id){
        return $this->where('parent_id', $id)->get()->lists('id');
    }

    /**
     * Update Image
     *
     * @param int $id
     * @param string $image
     * @return void
     */
    private function updateImage($image, $id)
    {
        $original_name = explode(".", $image->getClientOriginalName());
        $original_name = $original_name[0];

        $new_name = PREFIX_IMG_PRODUCT . str_slug($original_name, "-") . '.' . $image->getClientOriginalExtension();

        $path = public_path(TAG_IMAGE . $id);

        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }else{
            chmod($path, 0777);
        }
        Image::make($image->getRealPath())->save($path . '/' . $new_name);

        return $this->where('id', $id)->update(array('image' => $new_name));
    }

}
