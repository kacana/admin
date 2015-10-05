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
        $data['tags'] = Tag::all();
        return view('tag.index', $data);
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

    /*
     * get tags by parent id
     */

    public function getTags()
    {
        $tag = new Tag;
        $node = isset($_GET['node'])? $_GET['node']:0;
        $data = array();
        $parentTags = $tag->getTagByParentId($node);
        foreach($parentTags as $item){
            $i['label'] = $item->name;
            $i['id'] = $item->id;

            if($item->countChild()>0){
                $i['childs'] = $item->countChild();
                $i['load_on_demand'] = true;
            }else{
                $i['childs'] = 0;
                $i['load_on_demand'] = false;
            }
            $data[] = $i;
        }
        echo json_encode($data);
    }

    /*
     * show form create item
     */
    public function showFormCreate($parent_id=0)
    {
        return view('tag.form-create', array('parent_id' => $parent_id));
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
        $tag = Tag::find($id);
        if($tag->countChild()>0){
            $tag->deleteChild($id);
        }
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

    public function getTagById($parent_id = 0)
    {
        $tag = new Tag;
        $tags = $tag->getTagById($parent_id);
        echo json_encode($tags);
    }
}
