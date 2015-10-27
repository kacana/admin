@extends('layouts.client.master')

@section('content')
<div role="main" class="main shop">
    <div class="container">
        <hr class="tall">
        <div class="row">
            <div class="col-md-6">
                <div class="summary entry-summary">
                    <h1 class="shorter"><strong>{{$item->name}}</strong></h1>

                    <p class="price">
                        <span class="old-price">{{formatMoney($item->price)}}</span><br/>
                        <span class="amount">{{formatMoney($item->sell_price)}}</span>
                    </p>

                    <p class="taller">{{$item->short_description}}</p>
                    @if($item->color)
                    <div id="oi_product_color" class="product-color">
                        <div class="product-color-title cf">
                            <div class="lf f50">Chọn màu sắc</div>
                            <div class="lf f25 show-if-psize-exist" style="visibility:hidden;">Chọn kích cỡ</div>
                            <div class="lf f25">Chọn Số lượng</div>
                        </div>
                        <ul class="cf">
                            @foreach($item->color as $color)
                            <li class="cf">
                                <div class="lf f20"><img src="{{showProductImg(\App\models\ProductGallery::showImageColor($color->pivot->gallery_id), $item->id)}}"></div>
                                <div class="lf f80 cf">
                                    <div class="lf f38">{{$color->name}}</div>
                                    <div class="lf f62 cf">
                                        <div class="lf f50">&nbsp;</div>
                                        <div align="center" class="lf f50 change-soluong-by-size60509">
                                            <select data-id="60509" data-class="change-color-by-quantity60509" class="change-select-size-id">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <br/>
                    <div class="cf">
                        <div class="lr">
                            <form method="POST" action="{{url('cart/addProductToCart')}}">
                                <input type="hidden" name="product_id" value="{{$item->id}}">
                                <input type="hidden" name="product_name" value="{{$item->name}}">
                                <input type="hidden" name="product_price" value="{{$item->sell_price}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-primary add-to-cart">
                                    <i class="fa fa-shopping-cart"></i>
                                    Thêm vào giỏ hàng
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
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

