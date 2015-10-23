<?php namespace App\Http\Controllers\Client;

use App\models\Product;
use App\models\Tag;

class IndexController extends BaseController {

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $tag = new Tag;
        $product = new Product;
        $limit = 6;
        $mainTags = $tag->getMainTags();
        $data = array();
        foreach($mainTags as $t){
            $result['tag'] = $t->name;
            $result['products'] = $product->getItemsByTag($t, $limit);
            $data[] = $result;
        }

		return view('client.index.index', array('items'=>$data));
	}

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
}
