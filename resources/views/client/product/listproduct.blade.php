@extends('layouts.client.master')

@section('content')
    <div id="homepage" >
        <div class="block-tag" >
            <div class="block-tag-header" >
                <div class="container">
                    <div class="col-sm-8" >
                        <button type="button" class="btn btn-default" aria-label="Left Align" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-list" aria-hidden="true"></span> Filter
                        </button>
                        @include('client.product.sidebar')
                    </div>
                </div>
            </div>
            <div class="block-tag-body" >
                <div class="container" id="content">
                    @forelse($items as $item)
                        <div class="col-md-4 product-item" >
                            <div class="product-image" >
                                <div class="product-image-inside" >
                                    <a href="{{urlProductDetail($item)}}" title="{{$item->name}}"><img src="{{showProductImg($item->image, $item->id)}}" alt="{{$item->name}}"/></a>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-title"> <a href="{{urlProductDetail($item)}}" title="{{$item->name}}">{{$item->name}}</a></div>
                            </div>
                            <div class="product-action">
                                <div class="product-price pull-left">{{formatMoney($item->price)}}</div>
                                <!-- progress button -->
                                <div class="progress-button pull-right">
                                    <button id="_btn_{{$item->id}}" rel="popover" class="btn-advise" data-delay="100" ><span>Tư vấn</span></button>
                                </div><!-- /progress-button -->
                            </div>
                        </div>
                    @empty
                        <div>Dữ liệu đang cập nhật...</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="" value="{{$tag->id}}" id="tag-id"/>
@stop

@section('javascript')
    Kacana.homepage.init();
    Kacana.tagpage.init();
@stop
@include('client.partials.popup-modal')