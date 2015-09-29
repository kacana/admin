<?php namespace App\models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Image;

class Branch extends Model  {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'branch';
    protected $fillable = array('name', 'image', 'status', 'created', 'updated');
    public $timestamps = false;

    public function scopeSearch($query, $keyword){
        return $query->where('name', 'LIKE', '%$keyword%');
    }

    public function createItem($item)
    {
        $branch = new Branch;

        if (isset($item['image']) && ($item['image']!=='undefined')) {
            $image = $item['image'];
            $original_name = explode(".", $image->getClientOriginalName());
            $original_name = $original_name[0];
            $new_name = str_slug($original_name, "-") . '-' . time() . '.' . $image->getClientOriginalExtension();

            $path = public_path(BRANCH_IMAGE . date('Y-m-d'));
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            } else {
                chmod($path, 0777);
            }

            Image::make($image->getRealPath())->resize(200, 200)->save($path . '/' . $new_name);
            $branch->image = $new_name;
        }
        $branch->name = $item['name'];
        $branch->created = date('Y-m-d H:i:s');
        $branch->updated = date('Y-m-d H:i:s');
        $branch->save();
    }

    /**
     * update information
     *
     * @param id
     * @param options = array()
     * @return true or false
     */
    public function updateItem($id, $options){
        $branch = Branch::find($id);

        if(isset($options['image']) && ($options['image']!='undefined')){
            $image = $options['image'];
            $original_name = explode(".", $image->getClientOriginalName());
            $original_name = $original_name[0];
            $new_name = str_slug($original_name, "-") . '-' . time() . '.' . $image->getClientOriginalExtension();

            $path = public_path(BRANCH_IMAGE . date('Y-m-d', strtotime($branch->created)));

            if(!file_exists($path)){
                mkdir($path, 0777, true);
            }else{
                chmod($path, 0777);
            }
            Image::make($image->getRealPath())->resize(200, 200)->save($path . '/' . $new_name);
            $options['image'] = $new_name;
        }else{
            $options['image'] = $branch->image;
        }

        $options['updated'] = date('Y-m-d H:i:s');

        if(isset($options['_token'])){
            unset($options['_token']);
        }
        return $this->where('id', $id)->update($options);
    }
}
