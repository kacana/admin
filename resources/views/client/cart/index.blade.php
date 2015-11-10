@extends('layouts.client.master')

@section('content')
    <div role="main" class="main shop">
        <div class="container">
            <hr class="tall">
            <div class="row">
                <div class="col-md-12">
                    <div class="row featured-boxes">
                        <div class="col-md-12">
                            <div class="">
                                @if(count($cart)>0)
                                    <table class="table table-bordered table-responsive">
                                        <thead>
                                        <tr>
                                            <th class="product-name center">
                                                Sản phẩm
                                            </th>
                                            <th class="product-color center">
                                                Màu sắc
                                            </th>
                                            <th class="product-price center">
                                                Giá
                                            </th>
                                            <th class="product-quantity center">
                                                Số lượng
                                            </th>
                                            <th class="product-subtotal center">
                                                Tổng số tiền
                                            </th>
                                            <th class="center">Xoá</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cart as $item)

                                        <tr class="cart_table_item">
                                            <td class="product-name">
                                                <strong><a href="{{$item->options['urlDetail']}}">{{$item->name}}</a></strong>
                                            </td>
                                            <td class="product-color">
                                                @if(isset($item->options['color']))
                                                    <span class="color">{{$item->options['color'][0]}}</span>
                                                @else
                                                    <span class="color"> - </span>
                                                @endif
                                            </td>
                                            <td class="product-price">
                                                <span class="amount">{{formatMoney($item->price)}}</span>
                                            </td>
                                            <td class="product-quantity">
                                                <div class="">
                                                    <input type="number" data-id="{{$item->id}}" class="input-text qty qtywidth text" title="Qty" value="{{$item->qty}}" name="quantity" min="1" step="1">
                                                </div>
                                            </td>
                                            <td class="product-subtotal">
                                                <span class="amount"><strong class="amount-{{$item->id}}">{{formatMoney($item->subtotal)}}</strong></span>
                                            </td>
                                            <td class="product-remove">
                                                <button class="remove-cart" data-id="{{$item->id}}">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                    @else
                                    <p>Bạn không có sản phẩm nào trong giỏ hàng. </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="featured-boxes">
                        <div class="col-md-8">
                            <a type="button" class="btn btn-primary" href="/">Tiếp tục mua hàng</a>
                        </div>
                        @if(count($cart)>0)
                        <div class="col-md-4">
                            <div class="box-content">
                                <h2 class="cart-totals-title">Tổng số tiền</h2>
                                <table cellspacing="0" class="cart-totals no-border">
                                    <tbody>
                                    <tr class="cart-subtotal">
                                        <th>
                                            <strong>Tổng số tiền trong giỏ hàng</strong>
                                        </th>
                                        <td align="right">
                                            <strong><span class="amount total-amount">{{formatMoney($total)}}</span></strong>
                                        </td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>
                                            Shipping
                                        </th>
                                        <td align="right">
                                            Miễn phí<input type="hidden" value="free_shipping" id="shipping_method" name="shipping_method">
                                        </td>
                                    </tr>
                                    <tr class="total">
                                        <th>
                                            <strong>Tổng tiền đơn đặt hàng</strong>
                                        </th>
                                        <td align="right">
                                            <strong><span class="amount total-amount">{{formatMoney($total)}}</span></strong>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br/>
                            <div class="pull-right">
                                <button class="btn btn-primary" id="proceed">Thanh toán</button>
                            </div>
                        </div>
                         @endif
                    </div>
                    @if(count($cart)>0)
                        <div id="user-info" style="display:none">
                    <div class="row featured-boxes cart" id="checkout" >
                        <div class="col-md-6">
                            <div class="featured-box featured-box-secundary default">
                                <div class="box-content">
                                    <h4>Thông tin người mua hàng</h4>
                                    {!! Form::open(array('id'=>'form-user-info', 'method'=>'post', 'onsubmit'=>'return false'))!!}
                                    <div class="form-group">
                                        {!! Form::label('name', 'Họ và tên', array('class'=>'control-label col-sm-3'))!!}
                                        <div class="col-sm-9">
                                            {!! Form::text('name', '', array('class'=>'form-control'))!!}
                                            <span id="error-name" class="text-red error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('email', 'Email', array('class'=>'control-label col-sm-3'))!!}
                                        <div class="col-sm-9">
                                            {!! Form::text('email', '', array('class'=>'form-control'))!!}
                                            <span id="error-email" class="text-red error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('phone', 'Điện thoại', array('class'=>'control-label col-sm-3'))!!}
                                        <div class="col-sm-9">
                                            {!! Form::text('phone', '', array('class'=>'form-control'))!!}
                                            <span id="error-phone" class="text-red error"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="featured-box featured-box-secundary default">
                                <div class="box-content">
                                    <h4>Thông tin giao hàng</h4>
                                    <div class="form-group">
                                        {!! Form::label('name_2', 'Họ và tên', array('class'=>'control-label col-sm-3'))!!}
                                        <div class="col-sm-9">
                                            {!! Form::text('name_2', '', array('class'=>'form-control')) !!}
                                            <span id="error-name_2" class="text-red error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('phone_2', 'Điện thoại', array('class'=>'control-label col-sm-3'))!!}
                                        <div class="col-sm-9">
                                            {!! Form::text('phone_2', '', array('class'=>'form-control')) !!}
                                            <span id="error-phone_2" class="text-red error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('street', 'Địa chỉ', array('class'=>'control-label col-sm-3'))!!}
                                        <div class="col-sm-9">
                                            {!! Form::text('street', '', array('class'=>'form-control')) !!}
                                            <span id="error-street" class="text-red error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('city_id', 'Thành phố', array('class'=>'control-label col-sm-3'))!!}
                                        <div class="col-sm-4">
                                            {!! Form::select('city_id', $cities, '', array('class'=>'form-control', 'onchange'=>'Kacana.cart.changeCity()')) !!}
                                            <span id="error-city" class="text-red error"></span>
                                        </div>
                                        {!! Form::label('ward_id', 'Quận', array('class'=>'control-label col-sm-1'))!!}

                                        <div class="col-sm-4" id="ward-area">
                                            {!! Form::select('ward_id', $wards, '', array('class'=>'form-control', 'id'=>'ward')) !!}
                                            <span id="error-ward" class="text-red error"></span>
                                        </div>
                                        <input type="hidden" name="ward_id" id="ward_id"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row featured-boxes">
                        <div class="col-md-12">
                            <div class="actions-continue">
                                {!! Form::submit('Đặt hàng →', array('id'=>'process','class'=>'btn btn-lg btn-primary', 'onclick'=>'Kacana.cart.processCart()'))!!}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                        </div>
                        @endif
                </div>
            </div>

        </div>
    </div>
    <!-- confirm modal -->
    <div id="confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Xoá sản phẩm ra khỏi giỏ hàng</h4>
                </div>

                <div class="modal-body">
                    Bạn thật sự muốn xoá sản phẩm này ra khỏi giỏ hàng?
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
                    <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                </div>

            </div>
        </div>
    </div>
@stop
@section('javascript')
    Kacana.cart.init();
@stop

