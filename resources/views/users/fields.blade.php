<!-- Username Field -->
<div class="form-group col-sm-6">
    {!! Form::label('username', 'Username:') !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Avatar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('avatar', 'Avatar:') !!}
    {{ Form::file('avatar',array('class' => 'form-control','onchange'=>"checkHinhAnh(this); checkImage('image');", 'accept'=>"image/*")) }}
</div>
<div class="form-group col-sm-12">
     <img style="width: 100px"id="img" src="{{URL::to('/uploads').'/'}}<?php
        if(isset($user)) {
            echo $user->avatar;
        } else {
            echo 'no-image.jpg';
        }
     ?>" class="avatar"/>
</div>
<div class="clearfix"></div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control', 'onchange'=>"form.password_confirmation.pattern = this.value;"]) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password_confirmation', 'Password_confirmation:') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control', 'title'=>'Password confirmation wrong']) !!}
</div>

<!-- Is Admin Field -->
<div class="form-group col-sm-12">
    {!! Form::label('is_admin', 'Is Admin:') !!}
    {!! Form::select('is_admin', ['1' => 'ADMIN', '2' => 'USER'], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
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
