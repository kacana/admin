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
     * @param id
     * @param options = array()
     * @return true or false
     */
    public function updateItem($id, $options){

        $options['updated'] = date('Y-m-d H:i:s');
        if(isset($options['_token'])){
            unset($options['_token']);
        }
        $this->where('id', $id)->update($options);
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
                $item['type'] = $tag->type;
                $item['name'] = $tag->name;
                $item['childs'] = $childs;
                $data[] = $item;
            }
        }
        return $data;
    }
}
