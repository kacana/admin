<?php namespace App\Http\Controllers\Client;

use App\Http\Requests\RequestInfoRequest;
use Datatables;
use App\models\InfoRequest;
use Mail;


class InfoRequestController extends BaseController {

    /**
     * function name: sendRequest
     * @param Request request,
     * @return Response
     */
    public function createItem(RequestInfoRequest $request){
        $reqInfo = new InfoRequest;
        $re = $reqInfo->createItem($request->all());
        if(!empty($re)){
            $data = [
                'email' => $re['name'],
                'time'  => date('H:i', strtotime($re['created'])),
                'date'  => date('d/m/Y', strtotime($re['created']))
            ];
            //send email
//            Mail::send('client.emails.info-request-tmp', $data, function($message)
//            {
//                $message->to('lechiit@gmail.com', 'Admin')->subject('Yêu cầu tư vấn');
//            });
            echo json_encode($re);
        }
    }
}
