<?php namespace App\models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DB;

class ProductGallery extends Model  {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_gallery';
    public $timestamps = false;

    /**
     * Get the tags associated with product
     */
    public function product()
    {
        return $this->belongsTo('App\models\Product');
    }

    public static function showImageColor($id)
    {
        return DB::table('product_gallery')->where('id', $id)->pluck('image');
    }

    public function getImageFromProductAndColor($pid, $cid){
        $gallery_id =  DB::table('product_color')->where(array('product_id'=>$pid, 'color_id'=>$cid))->pluck('gallery_id');
        return DB::table('product_gallery')->where('id', $gallery_id)->pluck('image');

    }


}
