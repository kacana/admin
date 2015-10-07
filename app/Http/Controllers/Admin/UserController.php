<?php namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Image;
use Datatables;
use App\User;

class UserController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('user.index');
	}

    public function getUser()
    {
        $users = User::all();
        return Datatables::of($users)
            ->edit_column('image', function($row) {
                if(!empty($row->image)){
                    return showImage($row->image, PRODUCT_IMAGE . $row->id);
                }
            })
            ->edit_column('status', function($row){
                return showSelectStatus($row->id, $row->status, 'Kacana.user.setStatus('.$row->id.', 1)', 'Kacana.user.setStatus('.$row->id.', 0)');
            })
            ->edit_column('created', function($row){
                return showDate($row->created);
            })
            ->edit_column('updated', function($row){
                return showDate($row->updated);
            })
            ->add_column('action', function ($row) {
                return showActionButton('Kacana.user.show('.$row->id.')', 'Kacana.product.branch.removeBranch('.$row->id.')', true);
            })
            ->make(true);
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

    public function showCreateForm()
    {

    }

    public function remove($id)
    {

    }

    public function setStatus($id, $status)
    {

    }

}
