<div>
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <div style="display: flex;">
        <input type="file" style="width: 60%" class="filepond form-control filepond-input-circle"
            id="{{ $id }}" name="{{ $name }}" accept="image/png, image/jpeg, image/gif" />
        <img class="img-thumbnail" alt="200x200" width="200" src="velzon/assets/images/small/img-3.jpg">
    </div>
    <p class="input-error" data-error="{{ $name }}"></p>
</div>
