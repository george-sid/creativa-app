<div class="{{ $sm ? 'col-sm-' . $sm : '' }} {{ $md ? 'col-md-' . $md : '' }} {{ $lg ? 'col-lg-' . $lg : '' }} {{$customClass}}">
    <label for="{{$id}}" class="form-label">{{$title}} @if($required) <span style="color:#dc3545">*</span>@endif</label>
    <input type="{{$type}}" class="form-control" id="{{$id}}" name="{{$name}}" value="{{$value}}" placeholder="{{$placeholder}}" @if($required) required @endif>
    <div class="invalid-feedback"></div>
</div>