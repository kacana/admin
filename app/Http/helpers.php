<?php
/**
 * Created by PhpStorm.
 * User: chile
 * Date: 9/24/15
 * Time: 6:32 AM
 */

/*
 * show Image
 */
function showImage($image, $folder)
{
    return "<img width='50' height='50' src='".$folder."/". $image ."'/>";
}

function showProductImg($image, $id)
{
    return SITE_LINK . PRODUCT_IMAGE . $id . '/'.$image;
}

/*
 * format date
 */
function showDate($date, $is_date=0)
{
    if($is_date==0){
        return date('Y-m-d H:i', strtotime($date));
    }else{
        return date('Y-m-d', strtotime($date));
    }

}

/*
 * show edit, delete button
 */
function showActionButton($link_edit, $link_delete, $is_edit_popup=false, $is_delete=false)
{
    if($is_edit_popup == true){
        $str = "<a class='btn btn-default btn-xs' href='javascript:void(0)' onclick='".$link_edit."'><i class='fa fa-pencil'></i></a>";
    }else{
        $str = "<a class='btn btn-default btn-xs' href='".$link_edit."'><i class='fa fa-pencil'></i></a>";
    }
    if($is_delete == true) {
        $str .="<a href='javascript:void(0)' onclick='".$link_delete."'><i class='fa fa-remove'></i></a>";
    }
    return $str;
}

/*
 * show select status
 */
function showSelectStatus($id, $status, $active, $inactive){
    $str = "<div class='btn-group'>";
    $str .= "<a class='btn btn-default btn-xs dropdown-toggle' data-toggle='dropdown' id='status-btn-".$id."'>";
    if($status == 1){
        $str .= "<i class='glyphicon glyphicon-ok'></i> <span class='status'>Active</span> <span class='caret'></span></a>";
    }else{
        $str .= "<i class='glyphicon glyphicon-minus'></i> Inactive <span class='caret'></span></a>";
    }
    $str.= "<ul class='dropdown-menu'>";
    $str.= "<li><a href='#change_status' onclick='$active'><i class='glyphicon glyphicon-ok'></i>Active</a></li>";
    $str.= "<li><a href='#change_status' onclick='$inactive'><i class='glyphicon glyphicon-minus'></i>Inactive</a></li>";
    $str.= "</ul>";
    $str.= "</div>";
    return $str;
}

function showSelectStatusOrder($id, $status){
    $str = "<div class='btn-group' data-id='".$id."'>";

    $statusProperty = [];

    switch ($status){
        case 0 :{
            $statusProperty['text'] = 'Khách đặt hàng';
            $statusProperty['class'] = 'btn-info';
            $statusProperty['icon'] = 'fa-arrow-right';
            break;
        }
        case 1 :{
            $statusProperty['text'] = 'đơn hàng đã confirm';
            $statusProperty['class'] = 'btn-primary';
            $statusProperty['icon'] = 'fa-arrow-circle-o-right';
            break;
        }
        case 2 :{
            $statusProperty['text'] = 'Đặt Hàng';
            $statusProperty['class'] = 'btn-primary';
            $statusProperty['icon'] = 'fa-check';
            break;
        }
        case 3:{
            $statusProperty['text'] = 'Về tới kho';
            $statusProperty['class'] = 'btn-primary';
            $statusProperty['icon'] = 'fa-check-circle';
            break;
        }
        case 4 :{
            $statusProperty['text'] = 'Shipping';
            $statusProperty['class'] = 'btn-primary';
            $statusProperty['icon'] = 'fa-send';
            break;
        }
        case 100 :{
            $statusProperty['text'] = 'Khách nhận hàng';
            $statusProperty['class'] = 'btn-success';
            $statusProperty['icon'] = 'fa-smile-o';
            break;
        }
        case 101 :{
            $statusProperty['text'] = 'huỷ đơn hàng';
            $statusProperty['class'] = 'btn-danger';
            $statusProperty['icon'] = 'fa-question';
            break;
        }
    }

    $str .= "<a class='btn ".$statusProperty['class']." btn-sm dropdown-toggle' data-toggle='dropdown'>";
    $str .= "<i class='fa ".$statusProperty['icon']."'></i> <span class='status'>".$statusProperty['text']."</span> <span class='caret'></span></a>";
    $str.= "<ul class='dropdown-menu'>";
    $str.= "<li><a href='#change_status' data-status='1' ><i class='fa fa-arrow-circle-o-right'></i>đơn hàng đã confirm</a></li>";
    $str.= "<li><a href='#change_status' data-status='1' ><i class='fa fa-question'></i>huỷ đơn hàng</a></li>";
    $str.= "</ul>";
    $str.= "</div>";

    return $str;
}

/*
 * get controller name base on Route::currentRouteAction()
 */
function getControllerName($route_action)
{
    return substr($route_action, 0, (strpos($route_action, '@') -0) );
}

/*
 * format money
 */
function formatMoney($money)
{
    $money = $money/1000;
    $money = number_format($money,0, '', '.');
    return $money.'k';
}

/*
 * urlProductDetail
 * @params: product item
 */
function urlProductDetail($item)
{
    if(!empty($item)){
        if(!empty($item->name)){
            return URL::to('san-pham/' . $item->id . '-' . str_slug($item->name) . '.html');
        }
    }else{
        return '';
    }
}

/*
 * urlCategory
 */
function urlCategory($item)
{
    if(!empty($item)){
        if(!empty($item->name)){
            return URL::to($item->id . '-' . str_slug($item->name) . '.html');
        }
    }else{
        return '';
    }
}
function limitString($str, $len = 100){
    $strLen = strlen($str);
    $re = $str;
    if($strLen <= $len){
        $re = $str;
    }else{
        $re = substr($str, 0, $len);
        $re .= "...";
    }
    return $re;
}


