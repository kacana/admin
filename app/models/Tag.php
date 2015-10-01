<?php namespace App\models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Image;

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
    }

    /**
     * update information
     *
     * @param id
     * @param options = array()
     * @return true or false
     */
    public function updateItem($id, $options){
        $tag = Tag::find($id);
        $options['updated'] = date('Y-m-d H:i:s');
        if(isset($options['_token'])){
            unset($options['_token']);
        }
        $this->where('id', $id)->update($options);
    }

    public function countChild()
    {
        return $this->where('parent_id', $this->id)->count();
    }
}
