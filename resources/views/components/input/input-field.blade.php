<div>
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" class="form-control" id="{{ $id }}"
        placeholder="{{ $placeholder }}" value="{{ $value }}">
    <p class="input-error" data-error="{{ $name }}"></p>
</div>