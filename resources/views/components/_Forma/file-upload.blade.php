<div class="{{ $sm ? 'col-sm-' . $sm : '' }} {{ $md ? 'col-md-' . $md : '' }} {{ $lg ? 'col-lg-' . $lg : '' }} {{ $customClass }}">
    <div class="form-group">
        <label for="{{$id}}">{{$title}}</label>
        <div class="input-group mb-3"> 
            <input type="file" class="form-control file-upload-form" name="{{ $name }}" id="{{$id}}" {{$placeholder}}>
            <div class="invalid-feedback"></div> 
        </div>
    </div>
</div>