@extends('layouts.admin')

@section('title') {{ request()->user()->role }} @endsection
@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Category {{isset($category_data) ?'Update':'Add' }}
                    </h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            @if(isset($category_data))
                                {{ Form::open(['url' => route('category.update',$category_data->id), 'class' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                            @method('put')
                            @else
                                {{ Form::open(['url' => route('category.store'), 'class' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                            @endif
                            <div class="form-group row">
                                {{ Form::label('title','Title:',['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('title',@$category_data->title,['class' => 'form-control','id' => 'title','required' => true ]) }}
                                    @error('title')
                                    <span class=""alert-danger>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('Summary','summary:',['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::textarea('summary',@$category_data->summary,['class' => 'form-control','id' => 'summary','rows'=>5, 'style'=>'resize:none' ]) }}
                                    @error('summary')
                                    <span class=""alert-danger>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                                <div class="form-group row">
                                    {{ Form::label('is_parent','Is_parent:',['class' => 'col-sm-3']) }}
                                    <div class="col-sm-9">
                                        {{ Form::checkbox('is_parent','1',(isset($category_data)) ? @$category_data->is_parent:1,['id' => 'is_parent', ]) }}Yes
                                        @error('is_parent')
                                        <span class=""alert-danger>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row {{isset($category_data,$category_data->parent_id) && $category_data->parent_id != null ? '' : 'hidden'}}" id ="parent_div">
                                    {{ Form::label('parent','Parent:',['class' => 'col-sm-3']) }}
                                    <div class="col-sm-9">
                                        {{ Form::select('parent_id',$parent_cats,@$category_data->parent_id,['class' => 'form-control','id' => 'parent_id','placeholder'=>'<--select any one -->' ])}}
                                        @error('parent')
                                        <span class=""alert-danger>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {{ Form::label('status','Status:',['class' => 'col-sm-3']) }}
                                    <div class="col-sm-9">
                                        {{ Form::select('status',['active' => 'Active', 'inactive' => 'Inactive'],@$category_data->status,
                                         ['class' => 'form-control', 'required' => true, 'id' => 'status']) }}
                                        @error('status')
                                        <span class=""alert-danger>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                {{ Form::label('image','Image:',['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">

                                    {{ Form::file('image', [ 'id' => 'image', 'accept' => 'image/* ']) }}
                                    @error('image')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-4 ">
                                    @if(isset($category_data) && $category_data->image !="" && file_exists((public_path().'/uploads/category/'.$category_data->image)))
                                        <img src="{{asset('/uploads/category/'.$category_data->image)}}" alt="" class="img img-responsive img-thumbnail">
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                {{ Form::label('','',['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::button('<i class="fa fa-trash"></i> Reset', ['class' => 'btn btn-danger','type' => 'reset']) }}
                                    {{ Form::button('<i class="fa fa-paper-plane"></i> Submit', ['class' => 'btn btn-success',
                                    'type' => 'submit']) }}
                                </div>
                            </div>

                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection

@section('scripts')

    <script>
        $('#is_parent').change(function () {

            var is_checked = $('#is_parent').prop('checked');
           if(is_checked == false) {
               $('#parent_div').removeClass('hidden');
           }else{
               $('#parent_id').val('');
               $('#parent_div').addClass('hidden');
           }
        });
    </script>



@endsection
