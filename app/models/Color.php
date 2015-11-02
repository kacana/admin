<?php namespace App\models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Image;
use DB;

class Color extends Model  {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'color';
    public $timestamps = false;

    /**
     * Get the products associated with tags
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function product()
    {
        return $this -> belongsToMany('App\models\Product', 'product_color')->withPivot('gallery_id');
    }

    public function scopeShowName($query, $id)
    {
        return $query->where('id', $id)->lists('name');
    }

}
