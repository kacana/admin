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
                            <div class="product-price">{{formatMoney($item->price)}}</div>
                        </div>
                        <div class="product-action">
                            <div class="progress-button pull-left">
                                <button><span>Mua</span></button>
                                <svg class="progress-circle" width="70" height="70">
                                    <path d="m35,2.5c17.955803,0 32.5,14.544199 32.5,32.5c0,17.955803 -14.544197,32.5 -32.5,32.5c-17.955803,0 -32.5,-14.544197 -32.5,-32.5c0,-17.955801 14.544197,-32.5 32.5,-32.5z"/>
                                </svg>
                                <svg class="checkmark" width="40" height="40">
                                    <path d="m21.5,35.5l15.3,-23.2"/>
                                    <path d="m21.5,35.5l-8.5,-7.1"/></svg>
                                <svg class="cross" width="70" height="70">
                                    <path d="m35,35l-9.3,-9.3"/><path d="m35,35l9.3,9.3"/><path d="m35,35l-9.3,9.3"/><path d="m35,35l9.3,-9.3"/></svg>
                            </div><!-- /progress-button -->
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
    {{--$('.btn-advise').on('click', function(e){--}}
        {{--$('.btn-advise').not(this).popover('destroy');--}}
    {{--});--}}
    {{--Kacana.homepage.initPopover();--}}
    $(window).on('resize', function(){
        $('.btn-advise').popover('destroy');
        Kacana.homepage.initPopover();
    })
@stop
@include('client.partials.popup-modal')
