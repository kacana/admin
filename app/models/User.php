<?php namespace App\models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Image;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
    public $timestamps = false;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password', 'role'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    /**
     * Get the user associated with product
     */
    public function userType()
    {
        return $this->belongsTo('App\models\UserType');
    }

    public function createItem($item)
    {
        $user = new User;
        $user->password = md5($item['password']);
        $user->name = $item['name'];
        $user->email = $item['email'];
        $user->role = $item['role'];
        $user->user_type = $item['user_type'];
        $user->created = date('Y-m-d H:i:s');
        $user->updated = date('Y-m-d H:i:s');
        $user->save();

        //update image after save product
        if (isset($item['image']) && ($item['image']!=='undefined')) {
            $this->updateImage($item['image'], $user->id);
        }
    }

    function updateImage($image, $id)
    {
        $original_name = explode(".", $image->getClientOriginalName());
        $original_name = $original_name[0];

        $new_name = PREFIX_IMG_PRODUCT . str_slug($original_name, "-") . '.' . $image->getClientOriginalExtension();

        $path = public_path(USER_IMAGE . $id);

        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }else{
            chmod($path, 0777);
        }
        Image::make($image->getRealPath())->save($path . '/' . $new_name);

        return $this->where('id', $id)->update(array('image' => $new_name));
    }

    function updateItem($id, $item)
    {
        $item['updated'] = date('Y-m-d H:i:s');
        if(isset($item['_token'])){
            unset($item['_token']);
        }

        if(isset($item['user_id'])){
            unset($item['user_id']);
        }

        if(empty($item['password'])){
            unset($item['password']);
        }else{
            $item['password'] = md5($item['password']);
        }

        if (isset($item['image'])) {
            $this->updateImage($item['image'], $id);
            unset($item['image']);
        }else{
            unset($item['image']);
        }

        $this->where('id', $id)->update($item);
    }

}
