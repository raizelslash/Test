@extends('layouts.master')

@section('content')
    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url({{ asset('assets/home/images/bg-01.jpg') }});">
        <h2 class="ltext-105 cl0 txt-center">
            Register
        </h2>
    </section>


    <!-- Content page -->
    <section class="bg0 p-t-75 p-b-120">
        <div class="container">
            @include('admin.sections.notification')
            <div class="row p-b-148">
                <div class="col-md-12 col-lg-12">
                    <div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
                        <div class="row">

                            <div class="col-md-1">
                            </div>
                            <div class="col-md-5">

                                <h4 class="text-center">Seller</h4>
                                <hr>

                                {{ Form::open(['url'=>route('vendor-register'),'method' =>'post','class'=>'form']) }}

                                <div class="form-group row">
                                    <label for="" class="col-sm-12">
                                        Full Name:
                                    </label>
                                    {{ Form::text('name', '', ['class'=>'form-control form-control-sm', 'id'=>'seller_name', 'required' => true]) }}
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-12">
                                        Email:
                                    </label>
                                    {{ Form::email('email', '', ['class'=>'form-control form-control-sm', 'id'=>'seller_email', 'required' => true]) }}
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-12">
                                        Password:
                                    </label>
                                    {{ Form::password('password', ['class'=>'form-control form-control-sm', 'id'=>'seller_password', 'required' => true]) }}
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-12">
                                        Confirm Password:
                                    </label>
                                    {{ Form::password('password_confirmation',  ['class'=>'form-control form-control-sm', 'id'=>'seller_re_password', 'required' => true]) }}
                                    <span class="d-none alert-danger" id="seller_re_pass_error"></span>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-12">
                                        Address:
                                    </label>
                                    {{ Form::textarea('address', '', ['class'=>'form-control form-control-sm', 'id'=>'seller_address','rows'=>5, 'style'=>'resize:none;', 'required' => true]) }}
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-12">
                                        Phone:
                                    </label>
                                    {{ Form::text('phone', '', ['class'=>'form-control form-control-sm', 'id'=>'seller_phone', 'required' => true]) }}
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-12"></label>
                                    {{ Form::button('Submit',['class'=>'btn btn-success', 'id'=>'seller_btn', 'type' => 'submit']) }}
                                </div>

                                {{ Form::close() }}
                            </div>
                            <div class="col-md-1">
                            </div>

                            <div class="col-md-5">
                                <h4 class="text-center">
                                    Buyer
                                </h4>

                                <hr>





















                                {{ Form::open(['url'=>route('userr-register'),'method' =>'post','class'=>'form']) }}

                                <div class="form-group row">
                                    <label for="" class="col-sm-12">
                                        Full Name:
                                    </label>
                                    {{ Form::text('name', '', ['class'=>'form-control form-control-sm', 'id'=>'seller_name', 'required' => true]) }}
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-12">
                                        Email:
                                    </label>
                                    {{ Form::email('email', '', ['class'=>'form-control form-control-sm', 'id'=>'seller_email', 'required' => true]) }}
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-12">
                                        Password:
                                    </label>
                                    {{ Form::password('password', ['class'=>'form-control form-control-sm', 'id'=>'seller_password', 'required' => true]) }}
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-12">
                                        Confirm Password:
                                    </label>
                                    {{ Form::password('password_confirmation',  ['class'=>'form-control form-control-sm', 'id'=>'seller_re_password', 'required' => true]) }}
                                    <span class="d-none alert-danger" id="seller_re_pass_error"></span>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-12">
                                        Address:
                                    </label>
                                    {{ Form::textarea('address', '', ['class'=>'form-control form-control-sm', 'id'=>'seller_address','rows'=>5, 'style'=>'resize:none;', 'required' => true]) }}
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-12">
                                        Phone:
                                    </label>
                                    {{ Form::text('phone', '', ['class'=>'form-control form-control-sm', 'id'=>'seller_phone', 'required' => true]) }}
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-12"></label>
                                    {{ Form::button('Submit',['class'=>'btn btn-success', 'id'=>'seller_btn', 'type' => 'submit']) }}
                                </div>

                                {{ Form::close() }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection

@section('scripts')
    <script>
        $('#seller_re_password').keyup(function(){
            var password = $('#seller_password').val();
            var typing = $('#seller_re_password').val();

            if(password == typing){

                $('#seller_re_pass_error').addClass('d-none').html('');
                $('#seller_btn').removeAttr('disabled','disabled');
            } else {
                $('#seller_re_pass_error').removeClass('d-none').html('Password and confirm password does not match.');
                $('#seller_btn').attr('disabled','disabled');
            }
        });
    </script>
@endsection
