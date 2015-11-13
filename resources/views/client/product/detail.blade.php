@extends('layouts.client.master')

@section('content')
<div role="main" id="product-detail" class="main shop">
    <div class="container">
        <hr class="tall">
        <div class="row">
            <div class="col-md-5">
                <div class="summary entry-summary">
                    <h1 class="shorter">{{$item->name}}</h1>

                    <p class="price">
                        <span class="amount">{{formatMoney($item->sell_price)}}</span>
                    </p>

                    <p class="taller">{{$item->short_description}}</p>
                    <span class="has-error text-red"></span>
                    <form method="POST" action="" onsubmit="return false;" id="form-cart">
                        @if(count($item->color)>0)
                            <div id="oi_product_color" class="product-color">
                            <div class="product-color-title cf">
                                <div class="lf f50">Chọn màu sắc</div>
                                <div class="lf f25 show-if-psize-exist" style="visibility:hidden;">Chọn kích cỡ</div>
                                <div class="lf f25">Chọn Số lượng</div>
                            </div>
                            <ul class="cf">
                                @foreach($item->color as $color)
                                <li class="cf">
                                    <div class="lf f20">
                                        <img src="{{showProductImg(\App\models\ProductGallery::showImageColor($color->pivot->gallery_id), $item->id)}}">
                                    </div>
                                    <div class="lf f80 cf">
                                        <div class="lf f38 color_name">{{$color->name}}</div>
                                        <div class="lf f62 cf">
                                            <div class="lf f50">&nbsp;</div>
                                            <div align="center">
                                                <select data-id="{{$color->id}}" class="product_qty">
                                                    @for($i=0; $i<=10; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @else
                            <div id="oi_product_color">
                                <div class="lf f25">Chọn số lượng</div>
                                <div class="lf f25">
                                    <select name="product_qty" class="product_qty">
                                    @for($i=1; $i<=10; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                                </div>
                            </div>
                        @endif
                        <br/><br/>
                        <div class="cf">
                            <div class="lr">
                                <input type="hidden" name="product_id" value="{{$item->id}}">
                                <input type="hidden" name="product_name" value="{{$item->name}}">
                                <input type="hidden" name="product_price" value="{{$item->sell_price}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="qty" id="qty"/>
                                <button type="submit" class="btn btn-primary add-to-cart" id="add-cart-btn" onclick="Kacana.cart.addToCart()">
                                    <i class="fa fa-shopping-cart"></i>
                                    Thêm vào giỏ hàng
                                </button>
                            </div>
                    </form>
                            <div>
                                <button id="{{$item->id}}" rel="popover" class="btn-advise btn btn-primary" data-delay="100"><span>Tư vấn</span></button>
                            </div>
                        </div>

                </div>
            </div>
            <div class="col-md-6 col-md-offset-1">
                <div class="owl-carousel" data-plugin-options='{"items": 1}'>
                    @if($item->galleries && count($item->galleries)>0)
                        <?php $count = 1;?>
                        @foreach($item->galleries as $gallery)
                            <?php if($count==5)break;?>
                            <div>
                                <div class="thumbnail">
                                    <img alt="{{$item->name}}" class="img-responsive img-rounded" src="{{showProductImg($gallery->image, $item->id)}}">
                                </div>
                            </div>
                            <?php $count++;?>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <hr class="tall" />
        <div class="row">
            <div class="col-md-12">
                <h2>Thông tin chi tiết</h2>
                <div><?php echo $item->description?></div>
            </div>
        </div>

    </div>
</div>
@stop
@section('javascript')
    Kacana.productdetail.init();
@stop
@include('client.partials.popup-modal')

