<div class="row isotope-grid">
  @if($product_list)
   @foreach($product_list as $product_data)
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{$product_data->cat_id}}">
                <!-- Block2 -->
                <div class="block2">
                    <div class="block2-pic hov-img0">
                       <a  href="{{route('product-detail',$product_data->slug)}}"><img src="{{asset('uploads/products/Thumb-'.$product_data->image)}}" alt="IMG-PRODUCT"></a>


                    </div>

                    <div class="block2-txt flex-w flex-t p-t-14">
                        <div class="block2-txt-child1 flex-col-l ">
                            <a href="{{route('product-detail',$product_data->slug)}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                               {{$product_data->title}}
                            </a>

                                @if($product_data->discount < 10)
                                    <span class="stext-105 cl3" style="color: #f57224;">
									  Rs {{$product_data->price}}
                                </span>
                                    @else
                                    <span class="stext-105 cl3" style="color: #f57224;">
                                        @if($product_data->discount>0)
                                    									  Rs {{$percen=$product_data->price-($product_data->price * $product_data->discount /100)}}
                                                                    <br>
                                                                    <del style="color: #999;">

                                                                    Rs. {{$product_data->price}}


                                                                    </del>
                                                <span style="color: black;">
                                                                    {{$product_data->discount}}%
                                                 </span>
                                            @else{
                                        Rs {{$product_data->price}}
                                        }
                                    								</span>
@endif
                                @endif
                            <br>
                            <a href="{{route('product-detail',$product_data->slug)}}" data-id="{{$product_data->id}}" data-quantity="1" class="btn btn-primary add_to_cart" style="border-radius: 40px">
                                Shop now
                            </a>
                        </div>


                    </div>
                </div>
            </div>
       @endforeach
      @endif


</div>
