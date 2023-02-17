<div>
    <div>
        <h6 class="fw-semibold">{{ $label }}</h6>
        <select class="single-select2 form-control" data-dropdownParent="{{ $dropdownParent }}" id="{{ $id }}"
            name="{{ $name }}">
            @if ($selectOption)
                <option value="">Select</option>
            @endif
           {!! $options !!}
        </select>
        <p class="input-error" data-error="{{ $name }}"></p>
    </div>
</div>
