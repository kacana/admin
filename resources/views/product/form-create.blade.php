<section>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Thêm sản phẩm</h4>
                </div>
                {!! Form::open(array('id' =>'form-create-product', 'onsubmit'=>false, 'enctype'=>"multipart/form-data")) !!}
                    <div class="modal-body">
                        <!-- name -->
                        <div class="form-group">
                            {!! Form::label('name', 'Tên sản phẩm') !!}
                            {!! Form::text('name', null, array('required', 'class' => 'form-control', 'placeholder' => 'Tên sản phẩm')) !!}
                            <span id="error-name" class="has-error text-red"></span>
                        </div>

                        <!-- image -->
                        <div class="form-group">
                            {!! Form::label('image', 'Hình ảnh') !!}
                            {!! Form::file('image', null) !!}
                            <span id="error-image" class="has-error text-red"></span>
                        </div>

                        <!-- price -->
                        <div class="form-group">
                            {!! Form::label('price', 'Giá sản phẩm') !!}
                            {!! Form::text('price', null, array('required', 'class' => 'form-control', 'placeholder' => 'Gía sản phẩm')) !!}
                            <span id="error-price" class="has-error text-red"></span>
                        </div>

                        <!-- sell price -->
                        <div class="form-group">
                            {!! Form::label('sell_price', 'Giá bán sản phẩm') !!}
                            {!! Form::text('sell_price', null, array('required', 'class' => 'form-control', 'placeholder' => 'Giá bán sản phẩm')) !!}
                            <span id="error-sell-price" class="has-error text-red"></span>
                        </div>

                        <!-- description -->
                        <div class="form-group">
                            {!! Form::label('description', 'Mô tả sản phẩm') !!}
                            {!! Form::textarea('description') !!}
                        </div>

                        <!-- tags -->
                        <div class="form-group">
                            {!! Form::label('Tags', 'Tags') !!}
                            {!! Form::text('search-tags',null, array('class'=>'form-control', 'placeholder' => 'Tags', 'onfocus'=>'Kacana.product.listTags()', 'id'=>'tags')) !!}
                            <div id="select-tags" name="tags[]">

                            </div>
                        </div>

                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="button" id="btn-create" onclick="Kacana.product.createProduct()"class="btn btn-primary">Thêm mới</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
