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
                    <h3>Category List</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <a href="{{ route('category.create') }}" class="btn btn-success pull-right">
                            <i class="fa fa-plus"></i>
                            Add Category
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
                                <th>Is parent</th>
                                <th>Parent</th>
                                <th>Image</th>
                                <th>status</th>
                                <th>Action</th>
                                </thead>
                                <tbody>

                                @if($category)
                                    @foreach($category as $key => $category_info)
                                        <tr>
                                            <td>
                                                {{$key+1}}
                                            </td>
                                            <td>{{$category_info->title}}</td>
                                            <td>{{($category_info->is_parent == 1)? 'Yes' :'No'}}</td>
                                            <td>{{($category_info->parent_id)?$category_info->parent_data['title']:"---------"
                                            }}</td>
                                            <td>
                                                @if(file_exists(public_path().'/uploads/category/'.$category_info->image) && $category_info->image != null)
                                                    <img style="max-width: 150px;"      src="{{asset('/uploads/category/'.$category_info->image)}}" alt="" class="img img-responsive img-thumbnail">
                                                    @else
                                                    No image Found
                                                @endif
                                            </td>
                                            <td>{{ucfirst($category_info->status) }}</td>

                                            <td>
                                                <a href="{{route('category.edit',$category_info->id)}}" style="border-radius: 50%" class="btn btn-success"><i class="fa fa-pencil"></i></a>

                                                <form method="post"        action="{{route('category.destroy',$category_info->id)}}" onsubmit="return confirm('Are you sure you want to delete this category')">
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


