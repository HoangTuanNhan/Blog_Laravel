<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    {{ Form::file('image',array('class' => 'form-control','onchange'=>"checkHinhAnh(this); checkImage('image');", 'accept'=>"image/*")) }}
</div>
<div class="form-group col-sm-12">
    <img style="width: 100px"id="img" src="{{URL::to('/uploads').'/'}}<?php
    if (isset($categories)) {
        echo $categories->image;
    } else {
        echo 'no-image.jpg';
    }
    ?>" class="avatar"/>
</div>
<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('categories.index') !!}" class="btn btn-default">Cancel</a>
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
