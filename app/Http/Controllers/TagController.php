<?php namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use Datatables;
use App\models\Tag;


class TagController extends BaseController {

    /**
     * Show products.
     *
     * @return Response
     */
    public function index()
    {
        return view('tag.index');
    }

    /*
     * get tags
     */

    public function getTag()
    {
        $tags = Tag::all();
        return Datatables::of($tags)
            ->edit_column('status', function($row){
                return showSelectStatus($row->id, $row->status, 'Kacana.product.tag.setStatusTag('.$row->id.', 1)', 'Kacana.product.tag.setStatusTag('.$row->id.', 0)');
            })
            ->edit_column('created', function($row){
                return showDate($row->created);
            })
            ->edit_column('updated', function($row){
                return showDate($row->updated);
            })
            ->add_column('action', function ($row) {
                return showActionButton('Kacana.product.tag.showEditTagForm('.$row->id.')', 'Kacana.product.tag.removeTag('.$row->id.')', true);
            })
            ->make(true);
    }

    /**
     * create product
     *
     * @param Request request
     * @return Response
     */
    public function createTag(TagRequest $request)
    {
        $tag = new Tag;
        return $tag->createItem($request->all());
    }

    /**
     * edit tag
     *
     * @param TagRequest $request
     * @return Response
     */
    public function editTag(TagRequest $request)
    {
        $tag = new Tag;
        $id = $request->get('id');
        return $tag->updateItem($id, $request->all());
    }

    /**
     * remove Tag
     * @param $id
     */
    public function removeTag($id)
    {
        Tag::find($id)->delete();
    }

    /**
     * Show edit form tag
     *
     * @param TagRequest $request
     * @return Response
     */
    public function showEditFormTag($id)
    {
        if(!empty($id)){
            $tag = Tag::find($id);
            $data['item'] = $tag;
            return view('tag.form-edit',$data);
        }
    }

    /**
    * Set status of tag (0 = inactive; 1 = active)
    *
    * @param id, status
    * @return str
    */
    public function setStatusTag($id, $status)
    {
        $str = '';
        $tag = new Tag();
        if($tag->updateItem($id, (array('status'=>$status)))){
            if($status == 0){
                $str = "Đã chuyển sang trạng thái inactive thành công!";
            }else{
                $str = "Đã chuyển sang trạng thái active thành công!";
            }
        }
        return $str;
    }
}
