@extends('layouts.admin')

@section('title') {{ request()->user()->role }} @endsection
@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Product {{isset($product_data) ?'Update':'Add' }}
                    </h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            @if( request()->user()->role == 'admin' )
                            @if(isset($product_data))

                                {{ Form::open(['url' => route('product.update',$product_data->id), 'class' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                                @method('put')
                            @else
                                {{ Form::open(['url' => route('product.store'), 'class' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                            @endif
                                @else
                                @if(isset($product_data))

                                    {{ Form::open(['url' => route('getproductbyvendorforupdate',$product_data->id), 'class' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                                    @method('put')
                                @else
                                    {{ Form::open(['url' => route('getproductbyvendorforstore',request()->user()->id), 'class' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                                @endif

                            @endif
                            <div class="form-group row">
                                {{ Form::label('title','Title:',['class' => 'col-sm-12']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('title',@$product_data->title,['class' => 'form-control','id' => 'title','required' => true ]) }}
                                    @error('title')
                                    <span class=""alert-danger>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('summary','Summary:',['class' => 'col-sm-12']) }}
                                <div class="col-sm-9">
                                    {{ Form::textarea('summary',@$product_data->summary,['class' => 'form-control','id' => 'summary','rows'=>5, 'style'=>'resize:none' ]) }}
                                    @error('summary')
                                    <span class=""alert-danger>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('description','description:',['class' => 'col-sm-12']) }}
                                <div class="col-sm-9">
                                    {{ Form::textarea('description',@$product_data->description,['class' => 'form-control','id' => 'description','rows'=>5, 'style'=>'resize:none' ]) }}
                                    @error('description')
                                    <span class=""alert-danger>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                                @if( request()->user()->role == 'admin' )

                            <div class="row">
                                <div class="col-sm-{{(isset($child_cats) && !empty($child_cats)) ? 5 :12}}" id="parent_div">
                                    <div class="form-group row">
                                        {{Form::label('cat_id','Category:',['class'=>'col-sm-12'])}}
                                        <div class="col-12">
                                            {{Form::select('cat_id',$parent_cats,@$product_data->cat_id,['class'=>'form-control','id'=>'cat_id','required'=>true,'placeholder'=>'--select any one--'])}}
                                        </div>
                                    </div>
                                </div>
                                <div id="child-div" class="{{(isset($child_cats) && !empty($child_cats)) ?  '' : 'hidden'}}">
                                    <div class="col-sm-1">  </div>
                                    <div class="col-sm-5">
                                        <div class="form-group row">
                                            {{Form::label('child_cat_id','Sub-Category:',['class'=>'col-sm-12'])}}
                                            <div class="col-12">
                                                {{Form::select('child_cat_id',((isset($child_cats) && !empty($child_cats))? $child_cats : []),@$product_data->child_cat_id,['class'=>'form-control','id'=>'child_cat_id','placeholder'=>'select only one'])}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    @else

                                    <div class="row">
                                        <div class="col-sm-{{(isset($child_cats) && !empty($child_cats)) ? 5 :12}}" id="parent_div">
                                            <div class="form-group row">
                                                {{Form::label('cat_id','Category:',['class'=>'col-sm-12'])}}
                                                <div class="col-12">
                                                    {{Form::select('cat_id',$parent_cats,@$product_data->cat_id,['class'=>'form-control','id'=>'catt_id','required'=>true,'placeholder'=>'--select any one--'])}}
                                                </div>
                                            </div>
                                        </div>
                                        <div id="child-div" class="{{(isset($child_cats) && !empty($child_cats)) ?  '' : 'hidden'}}">
                                            <div class="col-sm-1">  </div>
                                            <div class="col-sm-5">
                                                <div class="form-group row">
                                                    {{Form::label('child_cat_id','Sub-Category:',['class'=>'col-sm-12'])}}
                                                    <div class="col-12">
                                                        {{Form::select('child_cat_id',((isset($child_cats) && !empty($child_cats))? $child_cats : []),@$product_data->child_cat_id,['class'=>'form-control','id'=>'child_cat_id','placeholder'=>'select only one'])}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif


                            <div class="form-group row">
                                {{Form::label('price','Price:',['class'=>'col-sm-3'])}}
                                <div class="col-sm-9">
                                    {{Form::number('price',@$product_data->price,['class'=>'form-control','required'=>true,'min'=>10])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('discount','Discount:',['class'=>'col-sm-3'])}}
                                <div class="col-sm-9">
                                    {{Form::number('discount',@$product_data->discount,['class'=>'form-control','max'=>95,'min'=>10])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('brand','Brand:',['class'=>'col-sm-3'])}}
                                <div class="col-sm-9">
                                    {{Form::text('brand',@$product_data->brand,['class'=>'form-control'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('stock','Stock:',['class'=>'col-sm-3'])}}
                                <div class="col-sm-9">
                                    {{Form::number('stock',@$product_data->stock,['class'=>'form-control','max'=>95,'min'=>10,'required'=>true])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('is_featured','Is_featured:',['class'=>'col-sm-3'])}}
                                <div class="col-sm-9">
                                    {{Form::checkbox('is_featured',1,@$product_data->is_featured)}}
                                </div>
                            </div>


                            <div class="form-group row">
                                {{Form::label('is_trending','Is_trending:',['class'=>'col-sm-3'])}}
                                <div class="col-sm-9">
                                    {{Form::checkbox('is_trending',1,@$product_data->is_trending)}}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('vendor_id','vendor_id:',['class' => 'col-sm-3 ']) }}
                                <div class="col-sm-9">
                                    {{ Form::select('vendor_id',$vendor_list,@$product_data->vendor_id,
                                     ['class' => 'form-control', 'required' => true, 'id' => 'status']) }}
                                    @error('vendor_id')
                                    <span class=""alert-danger>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row">
                                {{ Form::label('status','Status:',['class' => 'col-sm-12']) }}
                                <div class="col-sm-9">
                                    {{ Form::select('status',['active' => 'Active', 'inactive' => 'Inactive'],@$product_data->status,
                                     ['class' => 'form-control', 'required' => true, 'id' => 'status']) }}
                                    @error('status')
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
                                    @if(isset($product_data) && $product_data->image !="" && file_exists((public_path().'/uploads/products/'.$product_data->image)))
                                        <img src="{{asset('/uploads/products/Thumb-'.$product_data->image)}}" alt="" class="img img-responsive img-thumbnail">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('other_image','Related Image:',['class' => 'col-sm-12']) }}
                                <div class="col-sm-9">

                                    {{ Form::file('other_image[]', [ 'id' => 'other_image', 'accept' => 'image/* ','multiple'=>true]) }}
                                    @error('other_image')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                    @if(isset($product_data,$product_data->images ) && !empty($product_data->images))
                                        @foreach($product_data->images as $product_images)
                                            <div class="col-sm-3">
                                                <img src="{{asset('/uploads/products/Thumb-'.$product_images->image_name)}}" alt="" class="img-responsive img-thumbtail">
                                           {{Form::checkbox('del_image[]',$product_images->image_name)}}Delete
                                            </div>
                                            @endforeach
                                    @endif
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
$('#is_parent').change(function () {

var is_checked = $('#is_parent').prop('checked');
if(is_checked == false) {
$('#parent_div').removeClass('hidden');
}else{
$('#parent_id').val('');
$('#parent_div').addClass('hidden');
}
});
$('#cat_id').change(function() {
var cat_id=$('#cat_id').val();
$.ajax({
'url':"{{url('/admin/category/child/')}}/"+cat_id,
'type':'get',


}).done(function(data){
if(typeof(data)!="object" ){
data = $.parseJSON(data);
}
var option_html ='<option value="" selected>--select any one--</option>';
if(data.status){
$('#parent_div').removeClass('col-sm-12').addClass('col-sm-5');
$('#child-div').removeClass('hidden');
$.each(data.data,function(index,value){
option_html += "<option value='"+index+"'>"+value+" </option>";
});

}else{
$('#parent_div').removeClass('col-sm-5').addClass('col-sm-12');
$('#child-div').addClass('hidden');

}
$('#child_cat_id').html(option_html);

});

});
$('#catt_id').change(function() {
    var cat_id=$('#cat_id').val();
    $.ajax({
        'url':"{{url('/vendor/category/child/')}}/"+cat_id,
        'type':'get',


    }).done(function(data){
        if(typeof(data)!="object" ){
            data = $.parseJSON(data);
        }
        var option_html ='<option value="" selected>--select any one--</option>';
        if(data.status){
            $('#parent_div').removeClass('col-sm-12').addClass('col-sm-5');
            $('#child-div').removeClass('hidden');
            $.each(data.data,function(index,value){
                option_html += "<option value='"+index+"'>"+value+" </option>";
            });

        }else{
            $('#parent_div').removeClass('col-sm-5').addClass('col-sm-12');
            $('#child-div').addClass('hidden');

        }
        $('#child_cat_id').html(option_html);

    });

});
tinymce.init({
selector: '#description',
menubar: false,
branding: false,
plugins: 'print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
});
</script>



@endsection

