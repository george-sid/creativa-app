<div class="{{ $sm ? 'col-sm-' . $sm : '' }} {{ $md ? 'col-md-' . $md : '' }} {{ $lg ? 'col-lg-' . $lg : '' }} {{ $customClass }}">
    <div class="form-group">
        <label>{{ $title }}</label>
        <select class="form-control" name="{{ $name }}" id="{{ $id }}">
            @foreach($query as $data)
                <option value="{{ $data[$getValue] }}" @selected($value == $data[$getValue])>
                    {{ $data[$getLabel] }}
                </option>
            @endforeach
        </select>
        <div class="invalid-feedback"></div>
    </div>
</div>
