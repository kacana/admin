<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Thông tin đơn hàng</title>
</head>
<body style="font-family: arial; font-size:13px">
    <div>
        <p>Chào bạn <strong>{{$username}}!</strong></p>
        <p>Đơn hàng của bạn đã gửi thành công! Chúng tôi sẽ xem xét đơn hàng của bạn và liên hệ với bạn trong thời gian sớm nhất.</p>
        <p>Bên dưới là thông tin đơn hàng của bạn đặt mua tại <a href="{{$linkWebsite}}">{{$linkWebsite}}</a>, bạn vui lòng kiểm tra lại</p>
        <div>
            <div style="background:#0088cc; padding:7px;margin:0;color:#fff;text-align:center; font-size:15px">THÔNG TIN ĐƠN HÀNG</div>
            <div>
                @if(count($carts)>0)
                <div style="color:#0088cc;font-size:16px; padding:10px 0; font-weight: bold">Thông tin đơn hàng</div>
                <div>
                    <div>
                        <table cellpadding="0" cellspacing="0" style="font-size:14px">
                            <tbody>
                            @foreach($carts as $item)
                            <tr>
                                <td style="text-align: left; height:80px;width:50px;border-bottom:1px solid #ccc">
                                    <img src="{{$item->options['image']}}" width="50px"/>
                                </td>
                                <td style="text-align: left; width:210px; border-bottom:1px solid #ccc">
                                    <span>{{$item->name}}</span>
                                </td>

                                <td align="right" style="border-bottom:1px solid #ccc">
                                    <span><strong>{{formatMoney($item->subtotal)}}</strong></span>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="2" align="right" style="height:50px;padding-right:5px;">Tổng tiền: </td>
                                <td><strong style="color:red">{{$total}}</strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
                <div class="clr"></div>
                <div style="color:#0088cc;font-size:16px; padding:10px 0; font-weight: bold">Thông tin khách hàng</div>
                <p>Họ và tên: <strong>{{$receiveName}}</strong></p>
                <p>Địa chỉ nhận hàng: <strong>{{$receiveAddress}}</strong></p>
                <p>Điện thoại: <strong>{{$receivePhone}}</strong></p>
            </div>
            <br/>
            <div style="background:#0088cc; padding:15px;margin:0;color:#fff;text-align:center; font-size:15px"></div>
        </div>

    </div>

</body>
</html>