<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-12">
    {!! Form::label('image', 'Image:') !!}
   {{ Form::file('image',array('class' => 'form-control','onchange'=>"checkHinhAnh(this); checkImage('image');", 'accept'=>"image/*")) }}

</div>
<div class="form-group col-lg-12">
    <img style="width: 100px" id="img" src="{{URL::to('uploads/').'/'}}<?php
        if(isset($products)) {
            echo $products->image;
        } else {
            echo 'no-image.jpg';
        }
    ?>" class="avatar"/>
</div>
<div class="clearfix"></div>

<!-- Category Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('category_id', 'Category Id:') !!}
    {{ Form::select('category_id', $category_ids, null, ['class' => 'form-control', 'required']) }}
</div>

<!-- Author Field -->
<div class="form-group col-sm-12">
    {!! Form::label('author', 'Author:') !!}
    {!! Form::select('author', $author, null, ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('products.index') !!}" class="btn btn-default">Cancel</a>
</div>
<script>
    function checkHinhAnh(input) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var img = document.getElementById("img");
            img.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
    function checkImage(name) {
        //alert(name);
        var hinhAnh, msg = "";
        //check hinh anh
        hinhAnh = document.getElementsByName(name)[0];
        //alert(hinhAnh);

    }
</script>