<div class="{{ $sm ? 'col-sm-' . $sm : '' }} {{ $md ? 'col-md-' . $md : '' }} {{ $lg ? 'col-lg-' . $lg : '' }} {{ $customClass }}">
    <div class="form-group">
        <label>{{ $title }} @if($required) <span style="color:#dc3545">*</span>@endif</label>
        <select class="form-control" name="{{ $name }}" id="{{ $id }}" @if($required) required @endif>
            @foreach($query as $data)
                <option value="{{ $data[$getValue] }}" @selected($value == $data[$getValue])>
                    {{ $data[$getLabel] }}
                </option>
            @endforeach
        </select>
        <div class="invalid-feedback"></div>
    </div>
</div>
