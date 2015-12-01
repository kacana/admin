<header id="header">
    <div class="container">
        <div class="logo">
            <a href="/">
                <img alt="Porto" width="219" height="49" data-sticky-width="120" data-sticky-height="25" src="/images/client/homepage/logo.png">
            </a>
        </div>
        <div class="search">
            <form id="searchForm" action="page-search-results.html" method="get">
                <div class="input-group">
                    <input type="text" class="form-control search" name="q" id="q" placeholder="Tìm túi..." required>
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
        </div>
        <nav>

            <ul class="nav nav-pills nav-top">

                <li>
                    <a href="#"><i class="fa fa-truck"></i>Miễn phí vận chuyển</a>
                </li>

                <li>
                    <a href="#"><i class="fa fa-money"></i>Thanh toán khi nhận hàng</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-plane"></i>Ship hàng toàn quốc</a>
                </li>
                <li class="phone">
                    <span><i class="fa fa-phone"></i>(84) 906-054206</span>
                </li>
            </ul>

        </nav>
        <button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
            <i class="fa fa-bars"></i>
        </button>
    </div>
    <div class="navbar-collapse nav-main-collapse collapse">
        <div class="container">
            {{--<ul class="social-icons">--}}
                {{--<li class="facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook">Facebook</a></li>--}}
                {{--<li class="twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter">Twitter</a></li>--}}
                {{--<li class="linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin">Linkedin</a></li>--}}
            {{--</ul>--}}
            <nav class="nav-main mega-menu">
               @if(count($menu_items)>0)
                <ul class="nav nav-pills nav-main" id="mainMenu">
                    <li class="{{ ($id_active == 0)?'active':'' }}">
                        <a class="dropdown-toggle" href="/">Trang chủ</a>
                    </li>
                    @foreach($menu_items as $item)
                        @if(isset($item['childs']) && sizeof($item['childs']) > 0)
                        <li class="dropdown {{ ($id_active == $item['id'])?'active':''}}" >
                            <a class="dropdown-toggle" href="{{$item['tag_url']}}">
                               {{ $item['name'] }}
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @foreach($item['childs'] as $child)
                                    <li><a href="{{urlCategory($child)}}">{{ $child->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @else
                        <li>
                            <a href="{{$item['tag_url']}}">{{ $item['name'] }}</a>
                        </li>
                        @endif
                    @endforeach
                    <!-- cart -->
                    @if(Cart::count()>0)
                    <li class="dropdown mega-menu-item mega-menu-shop">
                        <a class="dropdown-toggle mobile-redirect" href="javascript:void(0)">
                            <i class="fa fa-opencart fa-6"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="mega-menu-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table cellspacing="0" class="cart table-border">
                                                <tbody>
                                                @foreach(Cart::content() as $item)
                                                    <tr class="cart_table_item">
                                                        <td class="product-image">
                                                            <img src="{{$item->options['image']}}" width="70px"/>
                                                        </td>
                                                        <td class="product-name">
                                                            <span><a class="a-b" href="{{isset($item->options['urlDetail'])?$item->options['urlDetail']:'#'}}">{{limitString($item->name)}}</a></span>
                                                        </td>

                                                        <td class="product-subtotal" align="right">
                                                            <span class="amount"><strong>{{formatMoney($item->subtotal)}}</strong></span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td class="actions" colspan="6">
                                                        <div>
                                                            <a href="/cart/showCart" class="btn btn-primary">Chi tiết</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    @else
                        <li class="disabled">
                            <a class="dropdown-toggle mobile-redirect" href="javascrip:void(0)">
                                <i class="fa fa-opencart fa-4"></i>
                            </a>
                        </li>
                    @endif
                </ul>
                @endif
            </nav>
        </div>
    </div>
</header>