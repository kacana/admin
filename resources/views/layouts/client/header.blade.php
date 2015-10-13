<header id="header">
    <div class="container">
        <div class="logo">
            <a href="index.html">
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
            <ul class="social-icons">
                <li class="facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook">Facebook</a></li>
                <li class="twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter">Twitter</a></li>
                <li class="linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin">Linkedin</a></li>
            </ul>
            <nav class="nav-main mega-menu">
               @if(count($menu_items)>0)
                <ul class="nav nav-pills nav-main" id="mainMenu">

                    <li class="active">
                        <a class="dropdown-toggle" href="index.html">Home</a>
                    </li>
                    @foreach($menu_items as $item)
                        @if(isset($item['childs']) && sizeof($item['childs']) > 0)
                        <li class="dropdown">
                            <a class="dropdown-toggle" href="#">
                               {{ $item['name'] }}
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @foreach($item['childs'] as $child)
                                <li><a href="about-us.html">{{ $child->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @else
                        <li>
                            <a href="#">{{ $item['name'] }}</a>
                        </li>
                        @endif
                    @endforeach
                </ul>
                @endif
            </nav>
        </div>
    </div>
</header>