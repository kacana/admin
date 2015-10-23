hel<?php
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


