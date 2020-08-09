<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ route(request()->user()->role,request()->user()->id) }}" class="site_title"><i class="fa fa-paw"></i> <span>{{request()->user()->role}} Panel</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">

{{--            <div class="profile_info">--}}
{{--                <span>Welcome,</span>--}}
{{--                <h2>{{ request()->user()->name }}</h2>--}}
{{--            </div>--}}
            <div class="clearfix"></div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">

                @if( request()->user()->role == 'admin' )
                <ul class="nav side-menu">

                    <li>
                        <a href="{{ route('banner-list') }}">
                            <i class="fa fa-image"></i>Banner Management <span class="fa fa-chevron-right"></span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('category.index')}}">
                            <i class="fa fa-sitemap"></i>Category Management <span class="fa fa-chevron-right"></span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('product.index')}}">
                            <i class="fa fa-shopping-bag"></i>Product Management <span class="fa fa-chevron-right"></span>
                        </a>
                    </li>

                    <li>
                        <a href="">
                            <i class="fa fa-user"></i>User Management <span class="fa fa-chevron-right"></span>
                        </a>
                    </li>

                    <li>
                        <a href="">
                            <i class="fa fa-shopping-cart"></i>Order Management <span class="fa fa-chevron-right"></span>
                        </a>
                    </li>

                    <li>
                        <a href="">
                            <i class="fa fa-dollar"></i>Ads Management <span class="fa fa-chevron-right"></span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('pages.index')}}">
                            <i class="fa fa-file"></i>Pages Management <span class="fa fa-chevron-right"></span>
                        </a>
                    </li>

                    <li>
                        <a href="">
                            <i class="fa fa-comments"></i>Review Management <span class="fa fa-chevron-right"></span>
                        </a>
                    </li>

                </ul>
                @else
                    <ul class="nav side-menu">

                        <li>
                            <a href="{{route('getproductbyvendor',request()->user()->id)}}">
                                <i class="fa fa-shopping-bag"></i>Manage your product <span class="fa fa-chevron-right"></span>
                            </a>
                        </li>
                    </ul>
                @endif

            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">

        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
