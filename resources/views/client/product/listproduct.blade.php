@extends('layouts.client.master')

@section('content')
    <div id="homepage">
        <div class="block-tag" id="as-search-results">
            <div class="block-tag-header" >
                <div class="container">
                    <div class="col-sm-8 as-accessories-filter-tile column large-6 small-4">
                        <button type="button" aria-expanded="false" class="as-filter-button btn btn-default" aria-controls="as-search-filters" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-list" aria-hidden="true"></span> Filter
                        </button>
                    </div>
                    <div class="column large-6  small-8 as-search-sort-padding">
                        @include('client.product.sort')
                    </div>
                </div>
            </div>
            <div class="block-tag-body as-accessories-results">
                @include('client.product.sidebar')
                <div class="container taglist as-search-results-tiles" id="content">
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
                    <div class="b-t"></div>
                </div>
            </div>
        </div>
        <div class="loader-response"><i class="fa fa-circle-o-notch fa-spin fa-3x"></i></div>
    </div>
    <input type="hidden" name="" value="{{$tag->id}}" id="tag-id"/>
    <input type="hidden" name="" value="" id="color-id"/>
    <input type="hidden" name="" value="" id="brand-id"/>
    <input type="hidden" name="" value="" id="sort"/>
@stop

@section('javascript')
    Kacana.homepage.init();
    Kacana.tagpage.init();
@stop
@include('client.partials.popup-modal')
