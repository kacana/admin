@extends('layouts.client.master')

@section('content')
<div id="homepage" >
    @if(count($items)>0)
        @foreach($items as $block)
            <div class="block-tag" >
            <div class="block-tag-header" >
                <div class="container">
                    <div class="tag-name col-sm-8" >
                        {{$block['tag']}}
                    </div>
                    <div class="show-all col-sm-4" >
                        Thêm <i class="fa fa-angle-right"></i>
                    </div>
                </div>
            </div>
            <div class="block-tag-body" >
                <div class="container" >
                    @if(count($block['products'])>0)
                        @foreach($block['products'] as $item)
                            <div class="col-md-4 product-item" >
                        <div class="product-image" >
                            <div class="product-image-inside" >
                                <a href="{{urlProductDetail($item)}}" title="{{$item->name}}"><img src="{{$item->image}}" alt="{{$item->name}}"/></a>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-title"> <a href="{{urlProductDetail($item)}}" title="{{$item->name}}">{{$item->name}}</a></div>

                        </div>
                        <div class="product-action">
                            <div class="product-price pull-left">{{formatMoney($item->price)}}</div>
                            <!-- progress button -->
                            <div class="progress-button pull-right">
                                <button id="_btn_{{$item->id}}" onclick="Kacana.homepage.showPopupRequest({{$item->id}})" rel="popover" class="btn-advise" data-original-title="Tư vấn" data-delay="100" ><span>Tư vấn</span></button>
                            </div><!-- /progress-button -->
                        </div>
                    </div>
                        @endforeach
                    @endif
                </div>
            </div>
    </div>
        @endforeach
    @endif

</div>

@stop

@section('javascript')
    Kacana.homepage.init();
    $(window).on('resize', function(){
        $('.btn-advise').popover('destroy');
        Kacana.homepage.initPopover();
    })
@stop
@include('client.partials.popup-modal')
