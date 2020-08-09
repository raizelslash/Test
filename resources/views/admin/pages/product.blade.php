@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
@endsection
@section('title') {{ request()->user()->role }} @endsection
@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Product Listing </h3>
                </div>
                @if( request()->user()->role == 'admin' )
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <a href="{{route('product.create')}}" class="btn btn-success"><i class="fa fa-plus"></i>Add product</a>
                    </div>
                </div>
                    @else
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <a href="{{route('getproductbyvendorforadd')}}" class="btn btn-success"><i class="fa fa-plus"></i>Add product</a>
                        </div>
                    </div>
                    @endif
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="x_panel">
                        @include('admin.sections.notification')
                        <div class="x_title">
                            <h2>Product List </h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content table-responsive">
                            <table class="table jambo_table">
                            <thead>
                            <th>S.n</th>
                            <th>Title</th>
                            <th>Summary</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>status</th>
                            <th>Added by</th>
                            <th>Image</th>
                            <th>Action</th>


                            </thead>
                                <tbody>
                                @if($all_products)
                                    @foreach($all_products as $key =>$product_list)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$product_list->title}}</td>
                                        <td>{{$product_list->summary}}</td>
                                        <td>{{$product_list->cat_info->title}}
                                            @if($product_list->child_cat_info)
                                                ({{$product_list->child_cat_info->title}})
                                            @endif

                                        </td>
                                        <td>NPR {{number_format($product_list->price)}}</td>
                                        <td>{{$product_list->stock}}</td>
                                        <td>{{ucfirst($product_list->status)}}</td>
                                        <td>{{($product_list->vendor_info['name']) ? $product_list->vendor_info['name']:'-'}}</td>
                                        <td>@if('Thumb-'.$product_list->image != null && file_exists(public_path().'/uploads/products/'.'Thumb-'.$product_list->image))

                                                <img src={{asset('/uploads/products/'.'Thumb-'.$product_list->image)}} alt="" class="img-responsive-img-thumbnail" style="max-width:100px">
                                        @endif
                                        </td>
                                        @if( request()->user()->role == 'admin' )
                                        <td><a href="{{route('product.edit',$product_list->id)}}" class="btn btn-success" style="border-radius: 50%"><i class="fa fa-edit"></i></a>
                                            <form action="{{route('product.destroy',$product_list->id)}} "method="post" onsubmit="return confirm('Are you sure to delete this product')">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger" style="border-radius: 50%" type="submit">

                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                            @else
                                            <td><a href="{{route('getproductbyvendorforedit',$product_list->id)}}" class="btn btn-success" style="border-radius: 50%"><i class="fa fa-edit"></i></a>
                                                <form action="{{route('getproductbyvendorfordestroy',$product_list->id)}} "method="post" onsubmit="return confirm('Are you sure to delete this product')">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger" style="border-radius: 50%" type="submit">

                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif

                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
@section('scripts')
    <script src ="{{asset('js/datatables.min.js')}}"></script>
    <script>
        $(document).ready( function () {
            $('.table').DataTable();
        } );
    </script>
@endsection

