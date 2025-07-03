<div class="{{ $sm ? 'col-sm-' . $sm : '' }} {{ $md ? 'col-md-' . $md : '' }} {{ $lg ? 'col-lg-' . $lg : '' }} {{$customClass}}">
    <label for="{{$id}}" class="form-label">{{$title}}</label>
    <input type="{{$type}}" class="form-control" id="{{$id}}" name="{{$name}}" value="{{$value}}" placeholder="{{$placeholder}}" >
    <div class="invalid-feedback"></div>
</div>