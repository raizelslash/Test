@extends('layouts.master')
@section('content')

    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{route('homepage')}}" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{route('category-detail',$products->cat_info->slug)}}" class="stext-109 cl8 hov-cl1 trans-04">
              {{$products->cat_info->title}}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            @if($products->child_cat_infos)
                <a href="{{route('sub-category-detail',[$products->cat_info->slug,$products->child_cat_infos->slug])}}" class="stext-109 cl8 hov-cl1 trans-04">
                    {{$products->child_cat_infos->title}}
                    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                </a>
                @endif
            <span class="stext-109 cl4">
                {{$products->title}}

            </span>
        </div>
    </div>

    <!-- Product Detail -->
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                @if($products->images)
                                        @foreach( $products->images as $related_images)
                                <div class="item-slick3" data-thumb="{{asset('uploads/products/Thumb-'.$related_images->image_name)}}">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="{{asset('uploads/products/'.$related_images->image_name)}}" alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{asset('uploads/products/'.$related_images->image_name)}}">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>


                                    @endforeach
                                    @endif





                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{$products->title}}
                        </h4>

                        <span class="mtext-106 cl2">
                        @if($products->discount < 10)
                                <span class="stext-105 cl3" style="color: #f57224;">
									  Rs {{$products->price}}
                                </span>

                        @else


                                    						<span class="stext-105 cl3" style="color: #f57224;">
                                    									  Rs {{$percen=$products->price * $products->discount /100}}
                                                                    <br>
                                                                    <del style="color: #999;">

                                                                    Rs. {{$products->price}}


                                                                    </del>
                                                <span style="color: black;">
                                                                    {{$products->discount}}%
                                                 </span>
                                    								</span>
                                    						</span>

                            @endif



                        <p class="stext-102 cl3 p-t-23">
                            {{$products->summary}}
                        </p>

                        <!--  -->
                        <div class="p-t-33">

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">
                                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>

                                    <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                        Add to cart
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!--  -->
                        <div class="flex-w flex-m p-l-100 p-t-40 respon7">


                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
                                <i class="fa fa-facebook"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
                                <i class="fa fa-twitter"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                        </li>



                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews ({{$products->product_review->count()}})</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    {!! html_entity_decode($products->description)!!}
                                </p>
                            </div>
                        </div>





                        <!-- - -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <div class="p-b-30 m-lr-15-sm">
                                        @if($products->product_review)
                                            @foreach($products->product_review  as $prod_review)
                                        <!-- Review -->
                                            <div class="flex-w flex-t p-b-68">
                                                <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                                    <img src="{{asset('uploads/pages/dummy-avatar-300x300.jpg')}}" alt="AVATAR">
                                                </div>

                                                <div class="size-207">
                                                    <div class="flex-w flex-sb-m p-b-17">
													<span class="mtext-107 cl2 p-r-20">
														{{$prod_review->user_info->name}}
													</span>

                                                        <span class="fs-18 cl11">
                                                            @for($i=1;$i<=5;$i++)
                                                                @if($i<=$prod_review->rate)

														<i class="zmdi zmdi-star"></i>
                                                                @else
                                                                    <i class=" zmdi zmdi-star-outline"></i>
                                                                @endif

														@endfor
													</span>
                                                    </div>

                                                    <p class="stext-102 cl6">
                                                       {{
                                                       $prod_review->review
                                                       }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                            @endif



                                        <!-- Add review -->
                                            @auth
                                        <form class="w-full"  action="{{route('submit-review',$products->id)}}" method="post" >

                                            @csrf
                                            <h5 class="mtext-108 cl2 p-b-7">
                                                Add a review
                                            </h5>

                                            <p class="stext-102 cl6">
                                                Your email address will not be published. Required fields are marked *
                                            </p>

                                            <div class="flex-w flex-m p-t-50 p-b-23">
												<span class="stext-102 cl3 m-r-16">
													Your Rating
												</span>

                                                <span class="wrap-rating fs-18 cl11 pointer">
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<input class="dis-none" type="number" name="rate">
												</span>
                                            </div>

                                            <div class="row p-b-25">
                                                <div class="col-12 p-b-5">
                                                    <label class="stext-102 cl3" for="review">Your review</label>
                                                    <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
                                                </div>


                                            </div>

                                            <button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                                Submit
                                            </button>
                                        </form>
                                                @else
                                        Please  <a  class="btn btn-link" href="{{route('login')}}">Login</a> to rate or review this product.
                                    @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
