@extends('layouts.admin')

@section('title') {{ request()->user()->role }} @endsection
@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left ">
                        <h3 >Welcome to the vendor panel</h3>

                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">

                            </div>
                        </div>
                    </div>
                </div>



{{--                <div class="row">--}}
{{--                    <div class="col-md-12 col-sm-12 col-xs-12">--}}

{{--                        <div class="x_panel">--}}
{{--                            @include('admin.sections.notification')--}}
{{--                           --}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

            </div>
        </div>
        <!-- /page content -->
@endsection

