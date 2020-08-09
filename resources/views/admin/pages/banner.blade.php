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
                    <h3>Banner List</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <a href="{{ route('banner-add') }}" class="btn btn-success pull-right">
                            <i class="fa fa-plus"></i>
                        Add Banner
                        </a>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        @include('admin.sections.notification')

                        <div class="x_content">
                           <table class="table">
                               <thead>
                               <th>S.n</th>
                               <th>Title</th>
                               <th>Link</th>
                               <th>image</th>
                               <th>Added_by</th>
                               <th>status</th>

                               <th>Action</th>
                               </thead>
                               <tbody>

                               @if($banner)
                                   @foreach($banner as $key => $banner_info)
                                       <tr>
                                   <td>
                                       {{$key+1}}
                                   </td>
                                       <td>{{$banner_info->title}}</td>

                                       <td><a href="{{$banner_info->link}}" class="btn-link" target="_banner"  >{{$banner_info->link}}</a></td>

                                           <td>@if(file_exists(public_path().'/uploads/banner/'.$banner_info->image))
                                                   <img style="max-width: 150px;"      src="{{asset('/uploads/banner/'.$banner_info->image)}}" alt="" class="img img-responsive img-thumbnail">
                                               @endif</td>
                                           <td>{{$banner_info->posted_by['name']}}</td>
                                           <td>{{ucfirst($banner_info->status) }}</td>

                                        <td>
                                            <a href="{{route('banner-edit',$banner_info->id)}}" style="border-radius: 50%" class="btn btn-success"><i class="fa fa-pencil"></i></a>

                                            <form method="post"        action="{{route('delete-banner',$banner_info->id)}}" onsubmit="return confirm('Are you sure you want to delete this banner')">
                                                @csrf
                                                @method('delete')

                                                <button class="btn btn-danger" style="border-radius: 50%"> <i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>

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
