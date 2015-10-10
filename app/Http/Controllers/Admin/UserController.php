<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\models\UserType;
use Image;
use Datatables;
use App\models\User;

class UserController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('admin.user.index');
	}

    public function getUser()
    {
        $users = User::all();
        return Datatables::of($users)
            ->edit_column('image', function($row) {
                if(!empty($row->image)){
                    return showImage($row->image, USER_IMAGE . $row->id);
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
                return showActionButton("/user/edit/".$row->id, 'Kacana.product.branch.removeBranch('.$row->id.')');
            })
            ->make(true);
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(UserRequest $request)
	{
        $user = new User;
        return $user->createItem($request->all());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($env, $domain, $id, UserRequest $request)
	{
        $user = User::find($id);
        $types = UserType::lists('name', 'id');
        if($request->all()){
            $user->updateItem($id, $request->all());
            $user = User::find($id);
        }
        return view('admin.user.edit',array('item' =>$user, 'types' =>$types));
	}

    public function showCreateForm()
    {
        $types = UserType::lists('name', 'id');
        return view("admin.user.form-create", array('types' => $types));
    }

    public function remove($id)
    {

    }

    /*
     * - function mame: setStatus
     */
    public function setStatus($env, $domain, $id, $status)
    {
        $str = '';
        $user = new User;
        if($user->updateItem($id, (array('status'=>$status)))){
            if($status == 0){
                $str = "Đã chuyển sang trạng thái inactive thành công!";
            }else{
                $str = "Đã chuyển sang trạng thái active thành công!";
            }
        }
        return $str;
    }

}
