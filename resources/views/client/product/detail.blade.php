@extends('layouts.client.master')

@section('content')
<div role="main" class="main shop">
    <div class="container">
        <hr class="tall">
        <div class="row">
            <div class="col-md-6">
                <div class="summary entry-summary">
                    <h1 class="shorter"><strong>{{$item->name}}</strong></h1>

                    {{--<div class="review_num">--}}
                        {{--<span class="count" itemprop="ratingCount">2</span> reviews--}}
                    {{--</div>--}}

                    {{--<div title="Rated 5.00 out of 5" class="star-rating">--}}
                        {{--<span style="width:100%"><strong class="rating">5.00</strong> out of 5</span>--}}
                    {{--</div>--}}

                    <p class="price">
                        <span class="old-price">{{formatMoney($item->price)}}</span><br/>
                        <span class="amount">{{formatMoney($item->sell_price)}}</span>
                    </p>

                    <p class="taller">{{$item->short_description}}</p>

                    <form enctype="multipart/form-data" method="post" class="cart">
                        <div class="quantity">
                            <input type="button" class="minus" value="-">
                            <input type="text" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                            <input type="button" class="plus" value="+">
                        </div>
                        <button href="#" class="btn btn-primary btn-icon">Đặt Mua</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="owl-carousel" data-plugin-options='{"items": 1}'>
                    @if($item->galleries && count($item->galleries)>0)
                        <?php $count = 1;?>
                        @foreach($item->galleries as $gallery)
                            <?php if($count==6)break;?>
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

