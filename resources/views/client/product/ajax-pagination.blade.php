@if(isset($page) && $page==1 && count($items)<1)
    <div>Sản phẩm đang được cập nhật...</div>
@endif
@foreach($items as $item)
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
@endforeach
<div class="b-t"></div>

