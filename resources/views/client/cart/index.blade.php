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
                                                <a href="shop-product-sidebar.html">{{$item->name}}</a>
                                            </td>
                                            <td class="product-price">
                                                <span class="amount"><strong>{{formatMoney($item->price)}}</strong></span>
                                            </td>
                                            <td class="product-quantity">
                                                <div class="quantity">
                                                    <a type="button" class="minus" href="{{url('cart/decreaseQty/'.$item->id)}}"><i class="fa fa-minus"></i></a>
                                                    <input type="text" id="_{{$item->id}}" class="input-text qty text" title="Qty" value="{{$item->qty}}" name="quantity" min="1" step="1">
                                                    <a type="button" class="plus" href="{{url('cart/increaseQty/'.$item->id)}}"><i class="fa fa-plus"></i></a>
                                                </div>
                                            </td>
                                            <td class="product-subtotal">
                                                <span class="amount"><strong>{{formatMoney($item->subtotal)}}</strong></span>
                                            </td>
                                            <td class="product-remove">
                                                <a title="Remove this item" class="remove" href="{{url('cart/removeCart/'.$item->id)}}">
                                                    <i class="fa fa-times"></i>
                                                </a>
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
                                            <strong><span class="amount">{{formatMoney($total)}}</span></strong>
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
                                            <strong><span class="amount">{{formatMoney($total)}}</span></strong>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br/>
                            <div class="pull-right">
                                <button class="btn btn-primary">Tiến hành kiểm tra</button>
                            </div>
                        </div>
                         @endif
                    </div>
                    @if(count($cart)>0)
                    <div class="row featured-boxes cart" id="userinfo">
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
                                            {!! Form::select('city_id', $cities, '', array('class'=>'form-control')) !!}
                                            <span id="error-city" class="text-red error"></span>
                                        </div>
                                        {!! Form::label('ward_id', 'Quận', array('class'=>'control-label col-sm-1'))!!}
                                        <div class="col-sm-4">
                                            {!! Form::select('ward_id', $wards, '', array('class'=>'form-control')) !!}
                                            <span id="error-ward" class="text-red error"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row featured-boxes">
                        <div class="col-md-12">
                            <div class="actions-continue">
                                {!! Form::submit('Hoàn tất đơn đặt hàng →', array('id'=>'process','class'=>'btn btn-lg btn-primary', 'onclick'=>'Kacana.cart.processCart()'))!!}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                        @endif
                </div>
            </div>

        </div>
    </div>
@stop
@section('javascript')

@stop

