
<ul class="dropdown-menu">
    <li>
        <a tabindex="-1" href="#">Danh mục</a>
        <ul>
            @foreach($links as $link)
                @if(isset($link['childs']) && sizeof($link['childs']) > 0)
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="{{$link['tag_url']}}">
                            {{ $link['name'] }}
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($link['childs'] as $child)
                                <li><a href="{{urlCategory($child)}}">{{ $child->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li>
                        <a href="{{ $link['tag_url'] }}">{{ $link['name'] }}</a>
                    </li>
                @endif
            @endforeach
        </ul>
    </li>

    <li class="divider"></li>
    <li><a tabindex="-1" href="#">Thương hiệu</a></li>
    <li class="divider"></li>
    <li><a tabindex="-1" href="#">Màu sắc</a></li>
</ul>