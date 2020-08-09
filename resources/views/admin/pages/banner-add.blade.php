 @extends('layouts.admin')

@section('title') {{ request()->user()->role }} @endsection
@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Banner {{($banner_data )?'Update':'Add' }}
                    </h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            @if($banner_data)
                                {{ Form::open(['url' => route('banner-update',$banner_data->id), 'class' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                                @else
                            {{ Form::open(['url' => route('banner-post'), 'class' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
@endif
                            <div class="form-group row">
                                {{ Form::label('title','Title:',['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('title',@$banner_data->title,['class' => 'form-control','id' => 'title','required' => true ]) }}
                                    @error('title')
                                        <span class=""alert-danger>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('link','Link:',['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::url('link',@$banner_data->link,['class' => 'form-control','id' => 'link','required' => true ]) }}
                                    @error('link')
                                        <span class=""alert-danger>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('status','Status:',['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::select('status',['active' => 'Active', 'inactive' => 'Inactive'],@$banner_data->status,
                                     ['class' => 'form-control', 'required' => true, 'id' => 'status']) }}
                                    @error('status')
                                        <span class=""alert-danger>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('image','Image:',['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">

                                    {{ Form::file('image', ['required' => ($banner_data ? false : true), 'id' => 'image', 'accept' => 'image/* ']) }}
                                    @error('image')
                                        <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-4 ">
                                    @if($banner_data && $banner_data->image !="" && file_exists((public_path().'/uploads/banner/'.$banner_data->image)))
                                        <img src="{{asset('/uploads/banner/'.$banner_data->image)}}" alt="" class="img img-responsive img-thumbnail">
                                @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('','',['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::button('<i class="fa fa-trash"></i> Reset', ['class' => 'btn btn-danger',
                                    'type' => 'reset']) }}
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

