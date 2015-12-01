@extends('layouts.admin.master')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Thông tin đơn hàng</h3>
                    </div><!-- /.box-header -->
                </div>
                <div class="col-xs-4">
                    <div class="box box-primary box-body"> <!-- Search results -->
                        <div class="box-header with-border">
                            <h3 class="box-title">Thông tin người mua hàng</h3>
                        </div><!-- /.box-header -->
                        <div class="modal-body">
                            <!-- name -->
                            <div class="form-group">
                                {!! Form::label('name', 'Họ và tên') !!}
                                {!! Form::text('name', $buyer->name, array('required', 'class' => 'form-control', 'placeholder' => 'Họ và tên', 'readonly'=>'true')) !!}
                            </div>

                            <!-- email -->
                            <div class="form-group">
                                {!! Form::label('email', 'Email') !!}
                                {!! Form::text('email', $buyer->email, array('required', 'class' => 'form-control', 'placeholder' => 'Email', 'readonly'=>'true')) !!}
                                <span id="error-email" class="has-error text-red"></span>
                            </div>

                            <!-- phone number -->
                            <div class="form-group">
                                {!! Form::label('phone', 'Điện thoại') !!}
                                {!! Form::text('phone', $buyer->phone, array('required', 'class' => 'form-control', 'placeholder' => 'Điện thoại', 'readonly'=>'true')) !!}
                                <span id="error-phone" class="has-error text-red"></span>
                            </div>
                        </div>
                    </div><!-- /.box -->
                    <div class="box box-primary box-body"> <!-- Search results -->
                        <div class="box-header with-border">
                            <h3 class="box-title">Thông tin người nhận hàng</h3>
                        </div><!-- /.box-header -->
                        {!! Form::open(array('method'=>'put', 'id' =>'form-edit-order')) !!}
                        <div class="modal-body">
                            <!-- name -->
                            <div class="form-group">
                                <input type="hidden" name="id" value="{{$user_address->id}}" />
                                {!! Form::label('name', 'Họ và tên') !!}
                                {!! Form::text('name', $user_address->name, array('required', 'class' => 'form-control', 'placeholder' => 'Họ và tên', 'readonly'=>'true')) !!}
                            </div>
                            <!-- phone number -->
                            <div class="form-group">
                                {!! Form::label('phone', 'Điện thoại') !!}
                                {!! Form::text('phone', $user_address->phone, array('required', 'class' => 'form-control', 'placeholder' => 'Điện thoại', 'readonly'=>'true')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('street', 'Địa chỉ')!!}
                                {!! Form::text('street', $user_address->street, array('class'=>'form-control', 'placeholder'=>'Địa chỉ')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('city_id', 'Thành phố')!!}
                                {!! Form::select('city_id', $cities, $user_address->city_id, array('class'=>'form-control', 'onchange'=>'Kacana.order.changeCity()')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('ward_id', 'Quận')!!}
                                {!! Form::select('ward_id',$wards, $user_address->ward_id, array('class'=>'form-control', 'id'=>'ward')) !!}
                            </div>

                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-default" href="/order">Huỷ</a>
                            <button type="submit" id="btn-update"class="btn btn-primary">Cập nhật</button>
                        </div>
                        {!! Form::close() !!}
                    </div><!-- /.box -->

                </div>
                <div class="col-xs-8">
                    <div class="box box-primary box-body"> <!-- Search results -->
                        <div class="box-header with-border">
                            <h3 class="box-title">Chi tiết đơn hàng</h3>
                        </div><!-- /.box-header -->

                        <div class="box-body table-responsive no-padding">
                            <table id="table" class="table row-border table-striped dataTable">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Created</th>
                                    <th class="nosort"></th>
                                </tr>
                                </thead>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>
        </div>
        <input type="hidden" id="order-id" value="{{$order->id}}" />
    </section>
@stop


@section('javascript')
    Kacana.order.listOrderDetails();
    Kacana.order.deleteOrderDetail();
@stop
@extends('admin.order.confirm-modal')