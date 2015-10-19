<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Http\Requests\AddressReceiveRequest;
use App\models\UserAddress;
use App\models\UserType;
use App\models\AddressReceive;
use GuzzleHttp\Psr7\Response;
use Image;
use Datatables;
use App\models\User;
use Form;
use App\models\AddressCity;
use App\models\AddressWard;


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
                return showActionButton("/user/edit/".$row->id, 'Kacana.user.removeUser('.$row->id.')');
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

    /*
     * - function mame: getUserAddress
     * list all user address on user detail page with table format
     * @params: uid - id of user
     */
    public function getUserAddress($env, $domain, $id)
    {
        $user_address = new UserAddress;
        $list_address = $user_address->getUserAddress($id);

        return Datatables::of($list_address)
            ->edit_column('name', function($row){
                return $row->addressReceive->name;
            })
            ->edit_column('email', function($row){
                return $row->addressReceive->email;
            })
            ->edit_column('phone', function($row){
                return $row->addressReceive->phone;
            })
            ->edit_column('street', function($row){
                return $row->addressReceive->street;
            })
            ->edit_column('city', function($row){
                return AddressCity::showName($row->addressReceive->city_id);
            })
            ->edit_column('ward', function($row){
                return AddressWard::showName($row->addressReceive->ward_id);
            })
            ->add_column('action', function ($row) {
                return showActionButton('Kacana.user.userAddress.showFormEdit('.$row->id.')', '', true);
            })
            ->make(true);
    }
    /*
     * - function mame: showFormEditUserAddress
     */
    public function showFormEditUserAddress($env, $domain, $id)
    {
        $address = AddressReceive::find($id);
        $cities = AddressCity::lists('name','id');
        $ward = new AddressWard();

        if(empty($address->city_id)){
            $city_id = CITY_ID_DEFAULT;
        }else{
            $city_id = $address->city_id;
        }
        $wards = $ward->getItemsByCityId($city_id)->lists('name', 'id');

        return view("admin.user.form-edit-address", array('item'=>$address, 'cities' =>$cities, 'wards'=>$wards));
    }

    /*
    * - function mame: editUserAddress
    */
    public function editUserAddress(AddressReceiveRequest $request)
    {
        $id = $request->get('id');
        $address = AddressReceive::find($id);
        $result = $address->updateItem($id, $request->all());
        echo json_encode($result);
    }

    /*
    * - function mame: showWardSelect
    */
    public function showListWards($env, $domain, $id)
    {
        $ward = new AddressWard;
        $lists = $ward->getItemsByCityId($id)->lists('name', 'id');
        echo Form::select('ward_id', $lists,null, array('class'=>'form-control'));
    }



}
