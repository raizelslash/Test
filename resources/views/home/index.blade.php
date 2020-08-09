@extends('layouts.master')
@section('title')Home Page  @endsection
@section('content')
    @section('meta')
        <meta  name="title" content="Home Page" >
        <meta  name="description" content="Home Page" >
        <meta  name="keywords" content="Home Page" >
        <meta   content="{{route('homepage')}} "  property="og:url">
        <meta   content="article"  property="og:type">
        <meta   content="Home Page"  property="og:title">
        <meta   content="{{asset('assets/home/images/logo.png')}}"  property="og:image">
        <meta   content="This is description"  property="og:description">

        @endsection
<!-- Slider -->
<section class="section-slide">
    <div class="wrap-slick1">
        <div class="slick1">
            @if($banner_list)
                @foreach($banner_list as $banner_data)
            <div class="item-slick1" style="background-image: url({{asset('uploads/banner/'.$banner_data->image)}})" >

                <div class="container h-full">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                        <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-101 cl2 respon2">
{{$banner_data->title}}
								</span>
                        </div>



                        <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                            <a href="{{$banner_data->link}}" target="_banner" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
@endforeach
@endif
        </div>
    </div>

</section>


<!-- Banner -->
<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
        <div class="row">
            @if($cats)
                @foreach($cats as $cat_info)
            <div class="col-md-4 col-xl-3 p-b-15 m-lr-auto">
                <!-- Block1 -->
                <div class="block1 wrap-pic-w">
                    <img src="{{asset('uploads/category/'.$cat_info->image)}}" alt="IMG-BANNER">

                    <a href="{{route('category-detail',$cat_info->slug)}}" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									{{$cat_info->title}}
								</span>

                            <span class="block1-info stext-102 trans-04">
									Shop now
								</span>
                        </div>

                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Shop Now
                            </div>
                        </div>
                    </a>
                </div>
            </div>
@endforeach
@endif



        </div>
    </div>
</div>


{{--<div class="block2">--}}
{{--    <div class="block2-pic hov-img0">--}}
{{--        <img src="images/product-05.jpg" alt="IMG-PRODUCT">--}}


{{--    </div>--}}

<section class="bg0 p-t-23 p-b-140">
    <div class="container">
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">
                Product Overview
            </h3>
        </div>

        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                    All Products
                </button>
                @if($cats)
                    @foreach($cats as $cat_info)
                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".{{$cat_info->id}}">
                            {{$cat_info->title}}
                        </button>



            @endforeach
                @endif
            </div>

            <div class="flex-w flex-c-m m-tb-10">

                <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                    <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                    <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    Search
                </div>
            </div>

            <!-- Search product -->
            <div class="dis-none panel-search w-full p-t-10 p-b-15">
                <div class="bor8 dis-flex p-l-15">
                    <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>

                    <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
                </div>
            </div>


        </div>

@include('home.sections.product-list')


    </div>
</section>

@endsection
