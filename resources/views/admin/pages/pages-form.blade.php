@extends('layouts.admin')

@section('title') {{ request()->user()->role }} @endsection
@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Pages Udate
                    </h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">

                                {{ Form::open(['url' => route('pages.update',$page_data->id), 'class' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                                @method('put')


                            <div class="form-group row">
                                {{ Form::label('title','Title:',['class' => 'col-sm-12']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('title',@$page_data->title,['class' => 'form-control','id' => 'title','required' => true ]) }}
                                    @error('title')
                                    <span class=""alert-danger>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('summary','Summary:',['class' => 'col-sm-12']) }}
                                <div class="col-sm-9">
                                    {{ Form::textarea('summary',@$page_data->summary,['class' => 'form-control','id' => 'summary','rows'=>5, 'style'=>'resize:none' ]) }}
                                    @error('summary')
                                    <span class=""alert-danger>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('description','description:',['class' => 'col-sm-12']) }}
                                <div class="col-sm-9">
                                    {{ Form::textarea('description',@$page_data->description,['class' => 'form-control','id' => 'description','rows'=>5, 'style'=>'resize:none' ]) }}
                                    @error('description')
                                    <span class=""alert-danger>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('image','Image:',['class' => 'col-sm-12']) }}
                                <div class="col-sm-9">

                                    {{ Form::file('image', [ 'id' => 'image', 'accept' => 'image/* ','required'=>false]) }}
                                    @error('image')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-4 ">
                                    @if(isset($page_data) && $page_data->image !="" && file_exists((public_path().'/uploads/products/'.$page_data->image)))
                                        <img src="{{asset('/uploads/products/Thumb-'.$page_data->image)}}" alt="" class="img img-responsive img-thumbnail">
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('','',['class' => 'col-sm-12']) }}
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
    <script src="{{asset( 'plugins/tinymce/tinymce.min.js') }}"></script>
    <script>

        tinymce.init({
            selector: '#description',
            menubar: false,
            branding: false,
            plugins: 'print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
        });
    </script>



@endsection

