@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Sản phẩm</h3>
                    </div><!-- /.box-header -->
                </div>

                <div class="box box-primary box-body"> <!-- Search results -->
                    <div class="box-header with-border">
                        <h3 class="box-title">Cập nhật thông tin người dùng</h3>
                    </div><!-- /.box-header -->
                    @if($_POST)
                        @if (count($errors) > 0)
                            <div class="alert alert-danger alert-dismissible">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <div class="alert alert-success alert-dismissible">
                                Cập nhật thành công
                            </div>
                        @endif
                    @endif
                    {!! Form::open(array('id' =>'form-edit-product', 'onsubmit'=>true, 'enctype'=>"multipart/form-data")) !!}
                    <div class="modal-body">
                        <!-- name -->
                        <div class="form-group">
                            {!! Form::label('name', 'Tên người dùng') !!}
                            {!! Form::text('name', $user->name, array('required', 'class' => 'form-control', 'placeholder' => 'Tên người dùng')) !!}
                        </div>

                        <!-- email -->
                        <div class="form-group">
                            {!! Form::label('email', 'Email người dùng') !!}
                            {!! Form::text('email', $user->email, array('required', 'class' => 'form-control', 'placeholder' => 'Email người dùng')) !!}
                            <span id="error-email" class="has-error text-red"></span>
                        </div>

                        <!-- password -->
                        <div class="form-group">
                            {!! Form::label('password', 'Mật khẩu người dùng') !!}
                            {!! Form::password('password', array('class' => 'form-control', 'placeholder' => 'Mật khẩu người dùng')) !!}
                            <span id="error-password" class="has-error text-red"></span>
                        </div>

                        <!-- image -->
                        <div class="form-group">
                            {!! Form::label('image', 'Hình ảnh') !!}
                            {!! Form::file('image', '') !!}
                            @if(!empty($image))
                                <br/><img width="50" height="50" src="/{{USER_IMAGE}} {{$user->id}}/{{$user->image}}"/>
                            @endif
                        </div>

                        <!-- role -->
                        <div class="form-group">
                            {!! Form::label('role', 'Role') !!}
                            {!! Form::select('role', array('admin' => 'Admin', 'guess' => 'Guess', 'buyer' => 'Buyer'),$user->role,array('class'=>'form-control')) !!}
                        </div>

                        <!-- user_type -->
                        <div class="form-group">
                            {!! Form::label('user_type', 'User type') !!}
                            {!! Form::select('user_type', $types, $user->user_type, array('class'=>'form-control')) !!}
                        </div>

                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-default" href="/user">Huỷ</a>
                        <button type="submit" id="btn-update"class="btn btn-primary">Cập nhật</button>
                    </div>
                    {!! Form::close() !!}
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@stop


