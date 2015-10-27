@extends('layouts.client.master')

@section('content')
    <div role="main" class="main shop">
        <div class="container">
            <hr class="tall">
            <div class="row">
                <div class="col-md-12">
                    <div class="row featured-boxes">
                        <div class="col-md-12">
                            <div class="featured-box featured-box-secundary featured-box-cart">
                                <div class="box-content">
                                    @if(count($cart))
                                        <table cellspacing="0" class="shop_table cart">
                                            <thead>
                                            <tr>
                                                <th class="product-remove">
                                                    &nbsp;
                                                </th>
                                                <th class="product-thumbnail">
                                                    &nbsp;
                                                </th>
                                                <th class="product-name">
                                                    Sản phẩm
                                                </th>
                                                <th class="product-price">
                                                    Giá
                                                </th>
                                                <th class="product-quantity">
                                                    Số lượng
                                                </th>
                                                <th class="product-subtotal">
                                                    Tiền
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($cart as $item)
                                            <tr class="cart_table_item">
                                                <td class="product-remove">
                                                    <a title="Remove this item" class="remove" href="{{url('cart/removeCart/'.$item->id)}}">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </td>
                                                <td class="product-thumbnail">
                                                    <a href="shop-product-sidebar.html">
                                                        <img width="100" height="100" alt="{{$item->name}}" class="img-responsive" src="">
                                                    </a>
                                                </td>
                                                <td class="product-name">
                                                    <a href="shop-product-sidebar.html">{{$item->name}}</a>
                                                </td>
                                                <td class="product-price">
                                                    <span class="amount">{{formatMoney($item->price)}}</span>
                                                </td>
                                                <td class="product-quantity">
                                                    <div class="quantity">
                                                        <a type="button" class="minus" href="{{url('cart/decreaseQty/'.$item->id)}}"><i class="fa fa-minus"></i></a>
                                                        <input type="text" id="_{{item->id}}" class="input-text qty text" title="Qty" value="{{$item->qty}}" name="quantity" min="1" step="1">
                                                        <a type="button" class="plus" href="{{url('cart/increaseQty/'.$item->id)}}"><i class="fa fa-plus"></i></a>
                                                    </div>
                                                </td>
                                                <td class="product-subtotal">
                                                    <span class="amount">{{formatMoney($item->subtotal)}}</span>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td class="actions" colspan="6">
                                                    <div class="actions-continue">
                                                        <a type="button" class="btn btn-primary" href="/">Tiếp tục mua hàng</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        @else
                                        <p>Bạn không có sản phẩm nào trong giỏ hàng. </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row featured-boxes cart">
                        <div class="col-md-6">
                            <div class="featured-box featured-box-secundary default">
                                <div class="box-content">
                                    <h4>Thông tin giao hàng</h4>
                                    <form action="" id="" method="post">
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>Country</label>
                                                    <select class="form-control">
                                                        <option value="">Select a country</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label>State</label>
                                                    <input type="text" value="" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Zip Code</label>
                                                    <input type="text" value="" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="submit" value="Update Totals" class="btn btn-default pull-right push-bottom" data-loading-text="Loading...">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="featured-box featured-box-secundary default">
                                <div class="box-content">
                                    <h4>Tổng số tiền</h4>
                                    <table cellspacing="0" class="cart-totals">
                                        <tbody>
                                        <tr class="cart-subtotal">
                                            <th>
                                                <strong>Tổng số tiền trong giỏ hàng</strong>
                                            </th>
                                            <td>
                                                <strong><span class="amount">{{formatMoney($total)}}</span></strong>
                                            </td>
                                        </tr>
                                        <tr class="shipping">
                                            <th>
                                                Shipping
                                            </th>
                                            <td>
                                                Miễn phí<input type="hidden" value="free_shipping" id="shipping_method" name="shipping_method">
                                            </td>
                                        </tr>
                                        <tr class="total">
                                            <th>
                                                <strong>Tổng tiền đơn đặt hàng</strong>
                                            </th>
                                            <td>
                                                <strong><span class="amount">{{formatMoney($total)}}</span></strong>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row featured-boxes">
                        <div class="col-md-12">
                            <div class="actions-continue">
                                <input type="submit" value="Hoàn tất đơn đặt hàng →" name="proceed" class="btn btn-lg btn-primary">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@stop
@section('javascript')

@stop

