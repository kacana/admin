<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\models\Tag;
use View;
use Route;
use Illuminate\Support\Facades\Request;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//menu on header
        View::composer('layouts.client.header', function($view){
            $params = Route::current()->parameters();
            $routeName = Route::currentRouteName();
            $id_active = "";
            if($routeName == 'listProductByCate'){
                $tag_id = isset($params['id']) ? $params['id'] : '';
                if($tag_id!=""){
                    $tag = Tag::find($tag_id);
                    $id_active = ($tag->parent_id!=0)?$tag->parent_id:$tag_id;
                }
            }
            $view->with('menu_items', Tag::getTags())->with('id_active', $id_active);
        });

        //menu on footer
        View::composer('layouts.client.footer', function($view){
            $view->with('menu_items', Tag::getTags());
        });

        //sidebar
        View::composer('client.product.sidebar', function($view){
            $segment = Request::segment(3);
            $view->with('links',Tag::getTags())->with('brands', \App\models\Branch::all())->with('colors', \App\models\Color::all())->with('url_tag',$segment);
        });

        //default active is home page

    }

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
