<div>
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <input @if ($required) required @endif type="{{ $type }}" name="{{ $name }}" class="form-control" id="{{ $id }}"
        placeholder="{{ $placeholder }}" value="{{ $value }}">
    <p class="input-error" data-error="{{ $name }}"></p>
    @error($name) <p class="input-error" data-error="{{ $message }}"></p> @enderror
</div>

