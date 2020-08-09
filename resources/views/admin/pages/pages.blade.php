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
                    <h3>Pages List</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

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

                                <th>summary</th>
                                <th>description</th>
                                <th>image</th>
                                <th>Action</th>
                                </thead>
                                <tbody>

                                @if($pages)
                                    @foreach($pages as $key => $pages_info)
                                        <tr>
                                            <td>
                                                {{$key+1}}
                                            </td>
                                            <td>{{$pages_info->title}}</td>





                                            <td>{{$pages_info->summary}}</td>
                                            <td>{{$pages_info->description}}</td>
                                            <td>@if(file_exists(public_path().'/uploads/pages/'.$pages_info->image))
                                                    <img style="max-width: 150px;"      src="{{asset('/uploads/pages/'.$pages_info->image)}}" alt="" class="img img-responsive img-thumbnail">
                                                @endif</td>


                                            <td>
                                                <a href="{{route('pages.edit',$pages_info->id)}}" style="border-radius: 50%" class="btn btn-success"><i class="fa fa-pencil"></i></a>

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
