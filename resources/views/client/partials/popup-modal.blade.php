<div id="popover-content" style="display: none;width:400px" >
    {!! Form::open(array('id' =>'form-create-request-info', 'onsubmit'=>false)) !!}
    <div class="modal-body">
        <!-- name -->
        <div class="form-group row">
            <div class="col-sm-3">{!! Form::label('name', 'Họ và tên') !!}</div>
            <div class="col-sm-9">{!! Form::text('name', null, array('required', 'class' => 'form-control')) !!}
                <span id="error-name" class="has-error text-red"></span>
            </div>

        </div>
        <div class="form-group row">
            <div class="col-sm-3">{!! Form::label('email', 'Email') !!}</div>
            <div class="col-sm-9">{!! Form::text('email', null, array('required', 'class' => 'form-control')) !!}
                <span id="error-email" class="has-error text-red"></span>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3">{!! Form::label('phone', 'Phone') !!}</div>
            <div class="col-sm-9">{!! Form::text('phone', null, array('required', 'class' => 'form-control')) !!}
            <span id="error-phone" class="has-error text-red"></span></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3">{!! Form::label('message', 'Tin nhắn') !!}</div>
                <div class="col-sm-9">{!! Form::textarea('message', null, array('required', 'class' => 'form-control')) !!}
            <span id="error-message" class="has-error text-red"></span></div>

        </div>
        {!! Form::hidden('product_id','', ['id'=>'product_id'])!!}
    </div>
    <div class="row">
        <div align="center"><button type="button" id="btn-create" onclick="Kacana.homepage.sendRequest()" class="btn btn-primary btn-icon">Gửi</button></div>
    </div>
    {!! Form::close() !!}
</div>