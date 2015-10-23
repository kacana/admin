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
                                <img src="{{$item->image}}"/>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-title">{{$item->name}}</div>
                            <div class="product-price">{{$item->price}}</div>
                        </div>
                        <div class="product-action">
                            <div class="progress-button">
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
                            <div class="progress-button">
                                <button onclick="Kacana.homepage.showPopupRequest(10)"><span>Tư vấn</span></button>
                                {{--<svg class="progress-circle" width="70" height="70"><path d="m35,2.5c17.955803,0 32.5,14.544199 32.5,32.5c0,17.955803 -14.544197,32.5 -32.5,32.5c-17.955803,0 -32.5,-14.544197 -32.5,-32.5c0,-17.955801 14.544197,-32.5 32.5,-32.5z"/></svg>--}}
                                {{--<svg class="checkmark" width="40" height="40">--}}
                                    {{--<path d="m21.5,35.5l15.3,-23.2"/>--}}
                                    {{--<path d="m21.5,35.5l-8.5,-7.1"/></svg>--}}
                                {{--<svg class="cross" width="70" height="70">--}}
                                    {{--<path d="m35,21l-9.3,-9.3"/>--}}
                                    {{--<path d="m35,21l9.3,9.3"/>--}}
                                    {{--<path d="m35,21l-9.3,9.3"/>--}}
                                    {{--<path d="m35,21l9.3,-9.3"/></svg>--}}
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
    {{--[].slice.call( document.querySelectorAll( '.progress-button' ) ).forEach( function( bttn, pos ) {--}}
        {{--new UIProgressButton( bttn, {--}}
            {{--callback : function( instance ) {--}}
                {{--var progress = 0,--}}
                {{--interval = setInterval( function() {--}}
                    {{--progress = Math.min( progress + Math.random() * 0.1, 1 );--}}
                    {{--instance.setProgress( progress );--}}

                    {{--if( progress === 1 ) {--}}
                        {{--instance.stop( pos === 1 || pos === 3 ? -1 : 1 );--}}
                        {{--clearInterval( interval );--}}
                    {{--}--}}
                {{--}, 150 );--}}
            {{--}--}}
        {{--} );--}}
    {{--} );--}}
@stop
@extends('client.partials.popup-modal')
