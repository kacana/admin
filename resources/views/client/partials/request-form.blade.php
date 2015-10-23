<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Tư vấn</h4>
        </div>
        {!! Form::open(array('id' =>'form-create-request-info', 'onsubmit'=>false)) !!}
        <div class="modal-body">
            <!-- name -->
            <div class="form-group">
                {!! Form::label('name', 'Họ và tên') !!}
                {!! Form::text('name', null, array('required', 'class' => 'form-control')) !!}
                <span id="error-name" class="has-error text-red"></span>
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Email') !!}
                {!! Form::text('email', null, array('required', 'class' => 'form-control')) !!}
                <span id="error-email" class="has-error text-red"></span>
            </div>
            <div class="form-group">
                {!! Form::label('phone', 'Phone') !!}
                {!! Form::text('phone', null, array('required', 'class' => 'form-control')) !!}
                <span id="error-phone" class="has-error text-red"></span>
            </div>
            <div class="form-group">
                {!! Form::label('message', 'Tin nhắn') !!}
                {!! Form::textarea('message', null, array('required', 'class' => 'form-control')) !!}
                <span id="error-message" class="has-error text-red"></span>
            </div>
            {!! Form::hidden('product_id', $id)!!}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ</button>
            <button type="button" id="btn-create" onclick="Kacana.homepage.sendRequest()" class="btn btn-primary btn-icon">Gửi</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>